// 가상의 상품 데이터
const products = [
	{
        name: '단백질원 75% 이상 2kg',
        price: 7620,
        image: '/shop/g.jpg',
        link: 'https://smartstore.naver.com/natureyutong/products/7940055469?NaPm=ct%3Dlnjwg0jk%7Cci%3D11b91aeca4796541418a9e2145ca44255f4c3a5b%7Ctr%3Dslct%7Csn%3D761330%7Chk%3Dfb369cec43300f04e2573394f5cb861b213ec8f2'
    },
	{
        name: '고양이 인섹트 알러지 제로 사료',
        price: 23400,
        image: '/shop/d.jpg',
        link: 'https://www.coupang.com/vp/products/6228032412?itemId=12500830186&vendorItemId=79769424199&src=1032001&spec=10305201&addtag=400&ctag=6228032412&lptag=I12500830186&itime=20231010144036&pageType=PRODUCT&pageValue=6228032412&wPcid=16806641120509109826716&wRef=cr.shopping.naver.com&wTime=20231010144036&redirect=landing&mcid=d6bd50170b2144adb921e7ee1936ffc6&isAddedCart='
    },
    {
        name: '건강한 인도어 기능성 사료 1.6kg',
        price: 23000,
        image: '/shop/a.jpg', // 이미지 경로를 웹 경로로 수정
        link: 'https://www.11st.co.kr/products/5920574938?NaPm=ct%3Dlnju5lq0%7Cci%3Daf4479d848c4aa4c92017e9044897c4a9d0e0da8%7Ctr%3Dslsl%7Csn%3D17703%7Chk%3Dfb844b13a7e21bef0049380f23f5bdeba32e22bf&utm_term=&utm_campaign=%B3%D7%C0%CC%B9%F6pc_%B0%A1%B0%DD%BA%F1%B1%B3%B1%E2%BA%BB&utm_source=%B3%D7%C0%CC%B9%F6_PC_PCS&utm_medium=%B0%A1%B0%DD%BA%F1%B1%B3'
    },
    {
        name: '캐츠랑 전연령 리브레 5kg',
        price: 11800,
        image: '/shop/b.jpg',
        link: 'https://smartstore.naver.com/happydogcat/products/4887807302?NaPm=ct%3Dlnjw2kqw%7Cci%3Da7c53397c2dc794ca685ae96d51b0ee303fdaa96%7Ctr%3Dslsl%7Csn%3D731483%7Chk%3D7888ecf09f28be7aa119352e696c3b97b50a9724'
    },
	{
        name: '로얄캐닌 고양이사료 4kg',
        price: 44800,
        image: '/shop/c.jpg',
        link: 'https://www.catpang.com/product/V000005380?inflow=naver&NaPm=ct%3Dlnjw58fc%7Cci%3D0874c9e77d4258fb0beead972f044a7333bc7c87%7Ctr%3Dslsl%7Csn%3D523853%7Chk%3D3563a995b5889cb51bf92d382bb7eb2a58e41665'
    },
	{
        name: '면역 유기농 기능성 사료',
        price: 27000,
        image: '/shop/e.jpg',
        link: 'https://www.coupang.com/vp/products/5696057687?itemId=12218586606&vendorItemId=85391676745&src=1032001&spec=10305201&addtag=400&ctag=5696057687&lptag=I12218586606&itime=20231010144345&pageType=PRODUCT&pageValue=5696057687&wPcid=16806641120509109826716&wRef=cr.shopping.naver.com&wTime=20231010144345&redirect=landing&mcid=00ddbf2e8c7c4d9fa7178279f7c50273&isAddedCart='
    },
	{
        name: '프라임캣 골드 15kg',
        price: 23500,
        image: '/shop/f.jpg',
        link: 'https://smartstore.naver.com/namyangpetfood/products/8795719205?NaPm=ct%3Dlnjwd88g%7Cci%3D673c980eae72a0feb15dc037e15ad7fcd2f4affd%7Ctr%3Dslsl%7Csn%3D698671%7Chk%3De378fcf7f6d73ebe7c1fd5092fec52ff6fd4020e'
    },
    // 나머지 상품 데이터...
];

// 상품 목록을 동적으로 생성하는 함수
function createProductList() {
    const productList = document.getElementById('product-list');

    products.forEach((product, index) => {
        const productItem = document.createElement('div');
        productItem.classList.add('product-item');

        const productImage = document.createElement('img');
        productImage.src = product.image;
        productImage.alt = product.name;

        const productName = document.createElement('h2');
        productName.textContent = product.name;

        const productPrice = document.createElement('p');
        productPrice.textContent = `가격: ${product.price}원`;

        const productDescription = document.createElement('p');
        productDescription.textContent = product.description;

        const productLink = document.createElement('a');
        productLink.textContent = '상품 보러 가기';
        productLink.href = product.link;
        productLink.target = '_blank';

        productItem.appendChild(productImage);
        productItem.appendChild(productName);
        productItem.appendChild(productPrice);
        productItem.appendChild(productDescription);
        productItem.appendChild(productLink);

        // 각 상품 사이에 구분선 추가
        if (index > 0) {
            const divider = document.createElement('hr');
			 divider.classList.add('divider'); // 새로운 CSS 클래스 추가
            productList.appendChild(divider);
        }

        productList.appendChild(productItem);
    });
}

// 페이지 로드 시 상품 목록 생성
window.onload = createProductList;
