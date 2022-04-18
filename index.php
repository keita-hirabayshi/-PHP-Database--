<?php
/**
 * モデルとクラス
 */
?>

<form action="<?php $_SERVER['REQUEST_URI']; ?>" method="POST">
    商品ID：<input type="text" name="product_id">
    <input type="submit">
</form>

<?php
require_once 'product.model.php';
require_once 'datasource.php';

use db\DataSource;
use model\ProductModel;

if(isset($_POST['product_id'])) {
    try {
        
        $product_id = $_POST['product_id'];

        $db = new DataSource();

        $result = $db->selectOne('
            select * from mst_products where id = :id and delete_flg <> 1;
        ', [':id' => $product_id], DataSource::CLS, ProductModel::class);
        // 取得するプロパティを指定してあげる。（modelで指定したもの以外のプロパティも同時に取得される。）
        // 書き間違えを防ぐために、クラス内の定数を取ってあげる必要がある。

        if(!empty($result)) {
            $result->echoProduct();
        } else {
            echo '一致する商品が見つかりません。';
        }

    } catch(PDOException $e) {
        echo '時間をおいて再度お試しください。';
    }
}