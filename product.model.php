<?php 
namespace model;
// 返り値が配列で返ってきているものを、クラスで帰ってくるようにする。
class ProductModel {
    public int $id;
    public string $name;
    public int $delete_flg;

    function echoProduct() {
        echo "商品名は[{$this->name}]です。";
    }
}