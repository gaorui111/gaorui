<?php
use  \yii\widgets\LinkPager;
$this->title = '商品列表';
?>
<table border="1" cellpadding="10">
    <tr>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品图片</td>
        <td>商品库存</td>
        <td>操作</td>
    </tr>
    <?php foreach($data as $val):?>
        <tr>
            <td><?=$val['good_name']?></td>
            <td><?=$val['good_price']?></td>
            <td><img src="<?=$val['good_img']?>" alt=""></td>
            <td><?=$val['good_stock']?></td>
            <td><a href="index.php?r=good/upd&id=<?=$val['id']?>">修改 |</a>
                <a href="index.php?r=good/delete&id=<?=$val['id']?>">删除 |</a>
                <a href="index.php?r=good/add">添加 |</a>
                <a href="index.php?r=good/upload">上传图片</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>