<?php
$this->title = '商品添加';
?>
<form action="index.php?r=good/doadd" method = "post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="good_name"></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="good_price"></td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td><input type="file" name="good_img"></td>
        </tr>
        <tr>
            <td>商品库存</td>
            <td><input type="text" name="good_stock"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="添加"></td>
        </tr>
    </table>
</form>