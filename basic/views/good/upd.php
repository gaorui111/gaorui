<?php
$this->title = '商品编辑';
?>
<form action="index.php?r=good/doupd" method = "post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="good_name" value="<?=$data->good_name?>"></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="good_price" value="<?=$data->good_price?>"></td>
        </tr>
<!--        <tr>-->
<!--            <td>商品图片</td>-->
<!--        <td><img src="--><?//=$val['good_img']?><!--" alt=""></td>-->
<!--        </tr>-->
        <tr>
            <td>商品库存</td>
            <td><input type="text" name="good_stock" value="<?=$data->good_stock?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?=$data->id?>">
                <input type="submit" value="提交">
            </td>
        </tr>
    </table>
</form>