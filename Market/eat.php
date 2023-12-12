<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사료 마켓</title>
    <link rel="stylesheet" href="styles.css">
	<style>
	h1{
		font-size: 50px;
		font-weight:bold;
		color: magenta;
	}

		
	body::after {
    content: "";
    background-image: url('/shop/back3.jpg');
    background-repeat: no-repeat;
    background-position: right top;
    position: fixed;
    top: 0;
    left: 40%; /* 오른쪽에서 40% 위치에 배치 */
    width: 50%;
    height: 100%;
    z-index: -1;
}

	</style>
</head>
<body>
    <header>
	<div style="text-align : center;">
        <h1>사료 마켓<img src="eat2.png" style="width:100px; height:100px;"/></h1>
		</div>
    </header>


    <main>
        <section id="product-list">
            <!-- 상품 목록이 여기에 동적으로 추가될 것입니다. -->
        </section>
		<script src="script2.js"></script>
	<script>
    // 페이지 로드 시 상품 목록 생성
    window.onload = createProductList;
</script>

    </main>
	<input type="button" value="메인 이동" onclick="location.href='hcmain.php'"
style="display:block; width:100px; text-align:right;  margin-left:auto; margin-right:auto; font-size:20px; padding:1px;">
</body>
</html>
