<?php

namespace addons\cms\model;

use addons\cms\library\Service;
use think\Cache;
use think\Db;
use think\Model;
use traits\model\SoftDelete;

/**
 * 文章模型
 */
class Archives extends Model
{
    protected $name = "cms_archives";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'url',
        'fullurl',
        'likeratio',
        'taglist',
        'create_date',
    ];
    protected static $config = [];

    protected static $tagCount = 0;

    use SoftDelete;

    /**
     * 批量设置数据
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        //替换付费内容标签
        if (isset($data['content'])) {
            $data['content'] = str_replace(['##paidbegin##', '##paidend##'], ['<paid>', '</paid>'], $data['content']);
            $data['content'] = str_replace(['$$paidbegin$$', '$$paidend$$'], ['<paid>', '</paid>'], $data['content']);
        }
        $this->data = array_merge($this->data, $data);
        $this->origin = $this->data;
        return $this;
    }

    protected static function init()
    {
        $config = get_addon_config('cms');
        self::$config = $config;
    }

    public function getCreateDateAttr($value, $data)
    {
        return human_date($data['createtime']);
    }

    public function getHasimageAttr($value, $data)
    {
        return $this->getData("image") ? true : false;
    }

    public function getImageAttr($value, $data)
    {
        $value = $value ? $value : self::$config['default_archives_img'];
        return cdnurl($value, true);
    }

    public function getImagesAttr($value, $data)
    {
        if (!$data['images']) {
            return '';
        }
        $images = explode(',', $data['images']);
        foreach ($images as $index => &$image) {
            $image = cdnurl($image, true);
        }
        return implode(',', $images);
    }

    public function getImagesListAttr($value, $data)
    {
        $images = $this->getAttr("images");
        return $images ? array_filter(explode(',', $images)) : [];
    }

    /**
     * 获取格式化的内容
     */
    public function getContentAttr($value, $data)
    {
        //如果内容中包含有付费标签
        $value = $data['content'];
        $pattern = '/<paid>(.*?)<\/paid>/is';
        if (preg_match($pattern, $value) && !$this->getAttr('ispaid')) {
            $paytype = static::$config['defaultpaytype'];
            $payurl = addon_url('cms/order/submit', ['id' => $data['id'], 'paytype' => $paytype]);
            $value = preg_replace($pattern, "<div class='alert alert-warning alert-paid'><a href='{$payurl}' class='btn-paynow' data-price='{$data['price']}' data-paytype='{$paytype}'>内容已经隐藏，点击付费后查看</a></div>", $value);
        }
        return $value;
    }

    /**
     * 获取金额
     */
    public function getPriceAttr($value, &$data)
    {
        if (isset($data['price'])) {
            return $data['price'];
        }
        $price = 0;
        if (isset($data['model_id'])) {
            $model = Modelx::get($data['model_id']);
            if ($model && in_array('price', $model['fields'])) {
                $price = Db::name($model['table'])->where('id', $data['id'])->value('price');
            }
        }
        $data['price'] = $price;
        return $price;
    }

    /**
     * 判断是否支付
     */
    public function getIspayAttr($value, &$data)
    {
        return $this->getAttr('ispaid');
    }

    /**
     * 判断是否支付
     */
    public function getIspaidAttr($value, &$data)
    {
        if (isset($data['ispaid'])) {
            return $data['ispaid'];
        }
        //如果未定义price字段或price字段值为0
        if (!isset($data['price']) || $data['price'] == 0) {
            return true;
        }
        $data['ispaid'] = \addons\cms\library\Order::check($data['id']);
        return $data['ispaid'];
    }

    /**
     * 判断是否是部分内容付费
     */
    public function getIsPaidPartOfContentAttr($value, $data)
    {
        if (isset($data['is_paid_part_of_content'])) {
            return $data['is_paid_part_of_content'];
        }
        $value = isset($this->origin['content']) ? $this->origin['content'] : '';
        $result = preg_match('/<paid>(.*?)<\/paid>/is', $value);
        $data['is_paid_part_of_content'] = $result;
        return $result;
    }

    /**
     * 获取下载地址列表
     */
    public function getDownloadurlListAttr($value, $data)
    {
        $titleArr = isset(self::$config['downloadtype']) ? self::$config['downloadtype'] : [];
        $downloadurl = (array)json_decode($data['downloadurl'], true);
        $downloadurl = array_filter($downloadurl);
        $list = [];
        foreach ($downloadurl as $index => $item) {
            if (!is_array($item)) {
                $urlArr = explode(' ', $item);
                $result['name'] = $index;
                $result['title'] = isset($titleArr[$index]) ? $titleArr[$index] : '其它';
                $result['url'] = cdnurl($urlArr[0], true);
                $result['password'] = isset($urlArr[1]) ? $urlArr[1] : '';
                $list[] = $result;
            } elseif (is_array($item) && isset($item['name']) && isset($item['url']) && $item['url']) {
                $item['url'] = cdnurl($item['url'], true);
                $result = $item;
                $result['title'] = isset($titleArr[$item['name']]) ? $titleArr[$item['name']] : '其它';
                $list[] = $result;
            }
        }
        return $list;
    }

    public function getTaglistAttr($value, &$data)
    {
        if (isset($data['taglist'])) {
            return $data['taglist'];
        }
        $tags = array_filter(explode(",", $data['tags']));
        $tagList = [];
        if (stripos(self::$config['rewrite']['tag/index'], ":id") !== false) {
            $tagList = Tag::where('name', 'in', $tags)->column('name,id');
        }
        $list = [];
        foreach ($tags as $k => $v) {
            $list[] = ['name' => $v, 'url' => addon_url('cms/tag/index', [':name' => $v, ':id' => isset($tagList[$v]) ? $tagList[$v] : '0'])];
        }
        $data['taglist'] = $list;
        return $list;
    }

    public function getUrlAttr($value, $data)
    {
        $diyname = isset($data['diyname']) && $data['diyname'] ? $data['diyname'] : $data['id'];
        $catename = isset($this->channel) && $this->channel ? $this->channel->diyname : 'all';
        $cateid = isset($this->channel) && $this->channel ? $this->channel->id : 0;
        return addon_url('cms/archives/index', [':id' => $data['id'], ':diyname' => $diyname, ':channel' => $data['channel_id'], ':catename' => $catename, ':cateid' => $cateid], static::$config['urlsuffix']);
    }

    public function getFullurlAttr($value, $data)
    {
        $diyname = isset($data['diyname']) && $data['diyname'] ? $data['diyname'] : $data['id'];
        $catename = isset($this->channel) && $this->channel ? $this->channel->diyname : 'all';
        $cateid = isset($this->channel) && $this->channel ? $this->channel->id : 0;
        return addon_url('cms/archives/index', [':id' => $data['id'], ':diyname' => $diyname, ':channel' => $data['channel_id'], ':catename' => $catename, ':cateid' => $cateid], static::$config['urlsuffix'], true);
    }

    public function getLikeratioAttr($value, $data)
    {
        return ($data['dislikes'] > 0 ? min(1, $data['likes'] / ($data['dislikes'] + $data['likes'])) : ($data['likes'] ? 1 : 0.5)) * 100;
    }

    public function getStyleTextAttr($value, $data)
    {
        $color = $this->getAttr("style_color");
        $color = $color ? $color : "inherit";
        $color = str_replace(['#', ' '], '', $color);
        $bold = $this->getAttr("style_bold") ? "bold" : "normal";
        $attr = ["font-weight:{$bold};"];
        if (stripos($color, ',') !== false) {
            list($first, $second) = explode(',', $color);
            $attr[] = "background-image: -webkit-linear-gradient(0deg, #{$first} 0%, #{$second} 100%);background-image: linear-gradient(90deg, #{$first} 0%, #{$second} 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;";
        } else {
            $attr[] = "color:#{$color};";
        }

        return implode('', $attr);
    }

    public function getStyleBoldAttr($value, $data)
    {
        return in_array('b', explode('|', $data['style']));
    }

    public function getStyleColorAttr($value, $data)
    {
        $styleArr = explode('|', $data['style']);
        foreach ($styleArr as $index => $item) {
            if (preg_match('/\,|#/', $item)) {
                return $item;
            }
        }
        return '';
    }

    /**
     * 获取内容页分页HTML
     */
    public function getPagerHTML($page, $total, $simple = false)
    {
        if ($total <= 1) {
            return '';
        }
        $result = \addons\cms\library\Bootstrap::make([], 1, $page, $total, $simple, ['path' => $this->url, 'simple' => $simple]);
        return "<div class='pager'>" . $result->render() . "</div>";
    }

    /**
     * 获取文档列表
     * @param $tag
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public static function getArchivesList($tag)
    {
        $config = get_addon_config('cms');
        $type = empty($tag['type']) ? '' : $tag['type'];
        $model = !isset($tag['model']) ? '' : $tag['model'];
        $channel = !isset($tag['channel']) ? '' : $tag['channel'];
        $special = !isset($tag['special']) ? '' : $tag['special'];
        $tags = empty($tag['tags']) ? '' : $tag['tags'];
        $condition = empty($tag['condition']) ? '' : $tag['condition'];
        $field = empty($tag['field']) ? '*' : $tag['field'];
        $flag = empty($tag['flag']) ? '' : $tag['flag'];
        $row = empty($tag['row']) ? 10 : (int)$tag['row'];
        $orderby = empty($tag['orderby']) ? 'createtime' : $tag['orderby'];
        $orderway = empty($tag['orderway']) ? 'desc' : strtolower($tag['orderway']);
        $limit = empty($tag['limit']) ? $row : $tag['limit'];
        $cache = !isset($tag['cache']) ? $config['cachelifetime'] === 'true' ? true : (int)$config['cachelifetime'] : (int)$tag['cache'];
        $imgwidth = empty($tag['imgwidth']) ? '' : $tag['imgwidth'];
        $imgheight = empty($tag['imgheight']) ? '' : $tag['imgheight'];
        $addon = empty($tag['addon']) ? false : $tag['addon'];
        $orderway = in_array($orderway, ['asc', 'desc']) ? $orderway : 'desc';
        $paginate = !isset($tag['paginate']) ? false : $tag['paginate'];
        $with = !isset($tag['with']) ? 'channel' : $tag['with'];
        $cache = !$cache ? false : $cache;
        $where = ['status' => 'normal'];

        $where['deletetime'] = ['exp', Db::raw('IS NULL')]; //by erastudio
        if ($model !== '') {
            $where['model_id'] = ['in', $model];
        }

        self::$tagCount++;

        $archivesModel = self::with($with)->alias('a');
        if ($channel !== '') {
            if ($type === 'son') {
                $subQuery = Channel::where('parent_id', 'in', $channel)->field('id')->buildSql();
                //子级
                $where['channel_id'] = ['exp', Db::raw(' IN ' . '(' . $subQuery . ')')];
            } elseif ($type === 'sons') {
                //所有子级
                $where['channel_id'] = ['in', Channel::getChannelChildrenIds($channel)];
            } else {
                $where['channel_id'] = ['in', $channel];
            }
        }
        //如果有设置标志,则拆分标志信息并构造condition条件
        if ($flag !== '') {
            if (stripos($flag, '&') !== false) {
                $arr = [];
                foreach (explode('&', $flag) as $k => $v) {
                    $arr[] = "FIND_IN_SET('{$v}', flag)";
                }
                if ($arr) {
                    $condition .= "(" . implode(' AND ', $arr) . ")";
                }
            } else {
                $condition .= ($condition ? ' AND ' : '');
                $arr = [];
                foreach (explode(',', str_replace('|', ',', $flag)) as $k => $v) {
                    $arr[] = "FIND_IN_SET('{$v}', flag)";
                }
                if ($arr) {
                    $condition .= "(" . implode(' OR ', $arr) . ")";
                }
            }
        }
        if ($special) {
            $specialModel = Special::get($special, [], true);
            if ($specialModel && $specialModel['tag_ids']) {
                $archivesModel->where("a.id", "in", function ($query) use ($specialModel) {
                    return $query->name("cms_taggable")->where("tag_id", "in", $specialModel['tag_ids'])->field("archives_id");
                });
                $cache = false;
            }
        }

        $order = $orderby == 'rand' ? Db::raw('rand()') : (preg_match("/\,|\s/", $orderby) ? $orderby : "{$orderby} {$orderway}");
        $order = $orderby == 'weigh' ? $order . ',id DESC' : $order;

        // 如果有筛选标签,则采用子查询
        if ($tags) {
            $tagIds = Tag::where('name', 'in', explode(',', $tags))->cache($cache)->limit($limit)->column("id");

            $archivesModel->where("a.id", "in", function ($query) use ($tagIds) {
                return $query->name("cms_taggable")->where("tag_id", "in", $tagIds)->field("archives_id");
            });
            $cache = false;
        }

        $modelInfo = null;
        $prefix = config('database.prefix');
        $archivesModel
            ->where($where)
            ->where($condition)
            ->field($field, false, $prefix . "cms_archives", "a")
            ->orderRaw($order);
        if ($addon && (is_numeric($model) || $channel)) {
            if ($channel) {
                //如果channel设置了多个值则只取第一个作为判断
                $channelArr = explode(',', $channel);
                $channelinfo = Channel::get($channelArr[0], [], true);
                $model = $channelinfo ? $channelinfo['model_id'] : $model;
            }
            // 查询相关联的模型信息
            $modelInfo = Modelx::get($model, [], true);
            if ($modelInfo) {
                $archivesModel->join($modelInfo['table'] . ' n', 'a.id=n.id', 'LEFT');
                if ($addon == 'true') {
                    $archivesModel->field('id,content', true, $prefix . $modelInfo['table'], 'n');
                } else {
                    $archivesModel->field($addon, false, $prefix . $modelInfo['table'], 'n');
                }
            }
        }

        if ($paginate) {
            $paginateArr = explode(',', $paginate);
            $listRows = is_numeric($paginate) ? $paginate : (is_numeric($paginateArr[0]) ? $paginateArr[0] : $row);
            $config = [];
            $config['var_page'] = isset($paginateArr[2]) ? $paginateArr[2] : 'apage' . self::$tagCount;
            $config['path'] = isset($paginateArr[3]) ? $paginateArr[3] : '';
            $config['fragment'] = isset($paginateArr[4]) ? $paginateArr[4] : '';
            $config['query'] = request()->get();
            $list = $archivesModel->paginate($listRows, (isset($paginateArr[1]) ? $paginateArr[1] : false), $config);
        } else {
            $list = $archivesModel->limit($limit)->cache($cache)->select();
        }

        if ($modelInfo) {
            $fieldsContentList = [];
            if ($modelInfo->fields) {
                $fieldsContentList = Fields::getFieldsContentList('model', $modelInfo->id);
            }

            foreach ($list as $index => &$item) {
                Service::appendTextAttr($fieldsContentList, $item);
            }
        }

        self::render($list, $imgwidth, $imgheight);
        return $list;
    }

    /**
     * 追加_text属性值
     * @param $fieldsContentList
     * @param $row
     */
    public static function appendTextAttr(&$fieldsContentList, &$row)
    {
        //附加列表字段
        array_walk($fieldsContentList, function ($content, $field) use (&$row) {
            if (isset($row[$field])) {
                if (isset($content[$row[$field]])) {
                    $list = [$row[$field] => $content[$row[$field]]];
                } else {
                    $keys = $values = explode(',', $row[$field]);
                    foreach ($values as $index => &$item) {
                        $item = isset($content[$item]) ? $content[$item] : $item;
                    }
                    $list = array_combine($keys, $values);
                }
            } else {
                $list = [];
            }
            $list = array_filter($list);
            $row[$field . '_text'] = implode(',', $list);
            $row[$field . '_list'] = $list;
        });
    }

    /**
     * 渲染数据
     * @param array $list
     * @param int   $imgwidth
     * @param int   $imgheight
     * @return array
     */
    public static function render(&$list, $imgwidth, $imgheight)
    {
        $width = $imgwidth ? 'width="' . $imgwidth . '"' : '';
        $height = $imgheight ? 'height="' . $imgheight . '"' : '';
        foreach ($list as $k => &$v) {
            $v['textlink'] = '<a href="' . $v['url'] . '">' . $v['title'] . '</a>';
            $v['channellink'] = '<a href="' . $v['channel']['url'] . '">' . $v['channel']['name'] . '</a>';
            $v['imglink'] = '<a href="' . $v['url'] . '"><img src="' . $v['image'] . '" border="" ' . $width . ' ' . $height . ' /></a>';
            $v['img'] = '<img src="' . $v['image'] . '" border="" ' . $width . ' ' . $height . ' />';
        }
        return $list;
    }

    /**
     * 获取分页列表
     * @param array $list
     * @param array $tag
     * @return array
     */
    public static function getPageList($list, $tag)
    {
        $imgwidth = empty($tag['imgwidth']) ? '' : $tag['imgwidth'];
        $imgheight = empty($tag['imgheight']) ? '' : $tag['imgheight'];
        return self::render($list, $imgwidth, $imgheight);
    }

    /**
     * 获取分页过滤
     * @param array $list
     * @param array $tag
     * @return array
     */
    public static function getPageFilter($list, $tag)
    {
        $exclude = empty($tag['exclude']) ? '' : $tag['exclude'];
        return $list;
    }

    /**
     * 获取分页排序
     * @param array $list
     * @param array $tag
     * @return array
     */
    public static function getPageOrder($list, $tag)
    {
        $exclude = empty($tag['exclude']) ? '' : $tag['exclude'];
        return $list;
    }

    /**
     * 获取上一页下一页
     * @param string $type
     * @param string $archives
     * @param string $channel
     * @param array  $tag
     * @return array
     */
    public static function getPrevNext($tag = [])
    {
        $type = isset($tag['type']) ? $tag['type'] : 'prev';
        $channel = isset($tag['channel']) ? $tag['channel'] : '';
        $archives = isset($tag['archives']) ? $tag['archives'] : '';
        $condition = isset($tag['condition']) ? $tag['condition'] : '';
        $model = self::where('id', $type === 'prev' ? '<' : '>', $archives)->where('status', 'normal');
        if ($channel !== '') {
            $model->where('channel_id', 'in', $channel);
        }
        if (isset($condition)) {
            $model->where($condition);
        }
        $model->order($type === 'prev' ? 'id desc' : 'id asc');
        $row = $model->find();
        return $row;
    }

    /**
     * 获取SQL查询结果
     */
    public static function getQueryList($tag)
    {
        $config = get_addon_config('cms');
        $sql = isset($tag['sql']) ? $tag['sql'] : '';
        $bind = isset($tag['bind']) ? explode(',', $tag['bind']) : [];
        $cache = !isset($tag['cache']) ? $config['cachelifetime'] === 'true' ? true : (int)$config['cachelifetime'] : (int)$tag['cache'];
        $name = md5("sql-" . $tag['sql']);
        $list = Cache::get($name);
        if (!$list) {
            $list = Db::query($sql, $bind);
            Cache::set($name, $list, $cache);
        }
        return $list;
    }

    /**
     * 关联模型
     */
    public function user()
    {
        return $this->belongsTo("\app\common\model\User", 'user_id', 'id', [], 'LEFT')->setEagerlyType(1);
    }

    /**
     * 关联模型
     */
    public function model()
    {
        return $this->belongsTo("Modelx", 'model_id')->setEagerlyType(1);
    }

    /**
     * 关联栏目模型
     */
    public function channel()
    {
        return $this->belongsTo("Channel", 'channel_id', 'id', [], 'LEFT')->setEagerlyType(1);
    }
}
