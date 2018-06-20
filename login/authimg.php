<?php
    // 檔案類型
    Header("Content-type: image/PNG");

    // 產生種子, 作圖形干擾用
    srand((double)microtime()*1000000);

    // 產生圖檔, 及定義顏色
    $im = imageCreate(70, 28);
    $back = ImageColorAllocate($im, 255, 255, 204);
    $font = ImageColorAllocate($im, 10, 10, 10);
    $point = ImageColorAllocate($im, 204, 0, 51);

    // 自己的密碼對照表與演算法
    include_once("codes.php");
    $authText = num2text($_GET['authnum']); // 轉換
    
    // 填入圖檔底色, 及寫入驗證文字至圖檔中
    imageFill($im, 0, 0, $back);
    imageString($im, 5, 10, 8, $authText, $font);

    // 插入圖形干擾點共 50 點, 可插入更多, 但可能會使圖形太過混雜
    for($i = 0; $i < 50; $i++) {
        imagesetpixel($im, rand() % 70 , rand() % 28 , $point);
    }

    // 定義圖檔類型並輸入, 最後刪除記憶體
    ImagePNG($im);
    ImageDestroy($im);
?>
