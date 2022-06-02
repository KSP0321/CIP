
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style__.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <title>CIP</title>
</head>

<body id="body-pd">
        <div class="menu" id="menu">
            <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
        </div>

        <div class="l-navbar" id="navbar">
    
            <nav class="nav"> 
            <ion-icon name="close-circle-outline" class="nav__toggle" id="nav-toggle_2"></ion-icon>
                <div class="map_wrap">
                    <div id="menu_wrap" class="menu_wrap">
                        <div class="popup">
                            <div class="popup-body">
                                <div class="body-content">
                                    <form onsubmit="searchPlaces(); return false;">
                                        장소 : <input type="text" placeholder="위치 검색" id="keyword" size="15"> 
                                        <button type="submit">검색하기</button> 
                                    </form>
                                </div>
                                <hr>
                                <ul id="placesList"></ul>
                            </div>
                            <div class="popup-foot">
                                <div id="pagination"></div>
                            </div>
                        </div>
                        <hr>    
                    </div>
                </div>
                
                <a href="javascript:KakaoLogout();" class="nav__link">
                    <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                    <span class="nav_name">Log out</span>
                </a>
                <script src="https://developers.kakao.com/sdk/js/kakao.js"> </script>
                <script type="text/javascript">
        Kakao.init('b054f0394862c8459139f0801d100ae3');
            Kakao.isInitialized();
      function KakaoLogout(){
        Kakao.API.request({
  url: '/v1/user/unlink',
  success: function(response) {
    console.log(response);
    location.href="http://ciptest.ga/index.html";
  },
  fail: function(error) {
    console.log(error);
    location.href="http://ciptest.ga/index.html";
  },
});
            //     if (!Kakao.Auth.getAccessToken()) {
            //         console.log('Not logged in.');
            //         return;
            //         }
            //     Kakao.Auth.logout(function() {
            //     console.log(Kakao.Auth.getAccessToken());
            //     success:res=>{
            //         Kakao.Auth.authorize({
            //         redirectUri: 'http://ciptest.ga'
            //  });}
            //     });
            }
            
Kakao.API.request({
  url: '/v1/user/unlink',
  success: function(response) {
    console.log(response);
  },
  fail: function(error) {
    console.log(error);
  },
});
       </script>
//             </nav>
//         </div>

        

            <div id="map" class="map" style="width:100%;height:100%;"></div>
            <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=3911680ceb2853064dd77af72246f542&libraries=services"></script>
            <script>
                
                var mapContainer = document.getElementById('map'), // 지도의 중심좌표
                    mapOption = {
                        center: new kakao.maps.LatLng(37.452053, 127.131652), // 지도의 중심좌표
                        level: 3 // 지도의 확대 레벨
                    };
        
                var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
                
                // HTML5의 geolocation으로 사용할 수 있는지 확인합니다 
                if (navigator.geolocation) {

                    // GeoLocation을 이용해서 접속 위치를 얻어옵니다
                    navigator.geolocation.getCurrentPosition(function(position) {

                        var lat = position.coords.latitude, // 위도
                            lon = position.coords.longitude; // 경도

                        var locPosition = new kakao.maps.LatLng(lat, lon); // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다
                        
                        map.setCenter(locPosition);

                    });

                    } else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다

                    var locPosition = new kakao.maps.LatLng(33.450701, 126.570667);
                    map.setCenter(locPosition);
                    }
                    <?php
                                        $con=mysqli_connect("cip2.cqq628j9la9u.ap-northeast-2.rds.amazonaws.com","admin","1q2w3e4r","CIP2")or die("MySQL 접속 실패");
                                        $sql = "select * from PARKING "; 
                                        $result = mysqli_query($con,$sql);
                    ?>
                // 지도에 마커를 표시합니다
                // 공석 개수를 나타내고 있는 마커는 계속 표시가 되고 있다
                var positions = [
                    <?php
                                    
                                        while($row=$result->fetch_assoc())
                                        {
                                                                                  
                                        
                    ?>
                    
                    {
                        content: '<div class="bubble" onclick="showinfo(<?php echo $row["PARKING_ID"];?>)" id="bubble"><span class="content"><?php echo $row["PARKING_NUMBER"]?></span></div>',
                        latlng: new kakao.maps.LatLng(<?php echo $row["PARKING_LAT"]; ?>, <?php echo $row["PARKING_LNG"]; ?>)
                    },
                    
                    <?php
                            }
                     ?> 

                    
                ];
                
                
               
                

                for (var i=0; i<positions.length; i++){
                    var customOverlay = new kakao.maps.CustomOverlay({
                        position: positions[i].latlng,
                        content : positions[i].content
                    });
                    customOverlay.setMap(map);
                    
                }

                // 장소 검색 객체를 생성합니다
                var ps = new kakao.maps.services.Places(); 

                // 키워드로 장소를 검색합니다
                searchPlaces();

                var markers = [];

                // 키워드 검색을 요청하는 함수입니다
                function searchPlaces() {

                    var keyword = document.getElementById('keyword').value;


                    // 장소검색 객체를 통해 키워드로 장소검색을 요청합니다
                    ps.keywordSearch( keyword, placesSearchCB);
                }

                // 장소검색이 완료됐을 때 호출되는 콜백함수 입니다
                function placesSearchCB(data, status, pagination) {
                    if (status === kakao.maps.services.Status.OK) {

                        // 정상적으로 검색이 완료됐으면
                        // 검색 목록과 마커를 표출합니다
                        displayPlaces(data);

                        // 페이지 번호를 표출합니다
                        displayPagination(pagination);

                    }
                    else if (status === kakao.maps.services.Status.ERROR){
                        alert("Error");
                    }
                }

                // 검색 결과 목록과 마커를 표출하는 함수입니다
                function displayPlaces(places) {

                    var listEl = document.getElementById('placesList'), 
                    menuEl = document.getElementById('menu_wrap'),
                    fragment = document.createDocumentFragment(), 
                    bounds = new kakao.maps.LatLngBounds(), 
                    listStr = '';
                    
                    // 검색 결과 목록에 추가된 항목들을 제거합니다
                    removeAllChildNods(listEl);

                    // 지도에 표시되고 있는 마커를 제거합니다
                    removeMarker();
                    
                    for ( var i=0; i<places.length; i++ ) {

                        // 마커를 생성하고 지도에 표시합니다
                        var placePosition = new kakao.maps.LatLng(places[i].y, places[i].x),
                            marker = addMarker(placePosition, i), 
                            itemEl = getListItem(i, places[i]); // 검색 결과 항목 Element를 생성합니다
                        
                        

                        // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
                        // LatLngBounds 객체에 좌표를 추가합니다
                        bounds.extend(placePosition);

                        // 마커와 검색결과 항목에 mouseover 했을때
                        // 해당 장소에 인포윈도우에 장소명을 표시합니다
                        // mouseout 했을 때는 인포윈도우를 닫습니다
                        (function(marker, title) {
                            //kakao.maps.event.addListener(marker, 'mouseover', function() {
                            //  displayInfowindow(marker, title);
                            //});
                            kakao.maps.event.addListener(marker, 'click', function() {
                                const point = marker.getPosition();
                                map.setCenter(point);
                                marker.setMap(map);
                                removeAllChildNods(listEl);
                                showMenu_popup();
                            });
                            itemEl.onclick =  function () {
                                const point = marker.getPosition();
                                map.setCenter(point);
                                marker.setMap(map);
                                removeAllChildNods(listEl);
                                showMenu_popup();
                            };
                        })(marker, places[i].phone);

                        fragment.appendChild(itemEl);
                    }
                    
                    // 검색결과 항목들을 검색결과 목록 Element에 추가합니다
                    listEl.appendChild(fragment);
                    menuEl.scrollTop = 0;

                    
                }

                // 검색결과 항목을 Element로 반환하는 함수입니다
                function getListItem(index, places) {

                    var el = document.createElement('li'),
                    itemStr = '<div class="info_name">' +
                                '   <h5>' + places.place_name + '</h5>';

                    if (places.road_address_name) {
                        itemStr += '    <span>' + places.road_address_name + '</span>' +
                                    '   <span class="jibun gray">' +  places.address_name  + '</span>';
                    } else {
                        itemStr += '    <span>' +  places.address_name  + '</span>'; 
                    }
                                
                    itemStr += '  <span class="tel">' + places.phone  + '</span>' +
                                '</div>';           

                    el.innerHTML = itemStr;
                    el.className = 'item';

                    return el;
                }

                // 마커를 생성하고 지도 위에 마커를 표시하는 함수입니다
                var content = '<div class="bubble" onclick="showinfo()" id="bubble"><span class="content">3</span></div>';
                function addMarker(position, idx, title) {
                    var imageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
                        imageSize = new kakao.maps.Size(36, 37),  // 마커 이미지의 크기
                        imgOptions =  {
                            spriteSize : new kakao.maps.Size(36, 691), // 스프라이트 이미지의 크기
                            spriteOrigin : new kakao.maps.Point(0, (idx*46)+10), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
                            offset: new kakao.maps.Point(13, 37) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
                        },
                        markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions),
                            marker = new kakao.maps.Marker({
                                position: position, // 마커의 위치
                                content: content
                        });

                    // 지도 위에 마커를 표출합니다
                    markers.push(marker);  // 배열에 생성된 마커를 추가합니다

                    return marker;
                }

                // 지도 위에 표시되고 있는 마커를 모두 제거합니다
                function removeMarker() {
                    for ( var i = 0; i < markers.length; i++ ) {
                        markers[i].setMap(null);
                    }   
                    markers = [];
                }

                // 검색결과 목록 하단에 페이지번호를 표시는 함수입니다
                function displayPagination(pagination) {
                    var paginationEl = document.getElementById('pagination'),
                        fragment = document.createDocumentFragment(),
                        i; 

                    // 기존에 추가된 페이지번호를 삭제합니다
                    while (paginationEl.hasChildNodes()) {
                        paginationEl.removeChild (paginationEl.lastChild);
                    }

                    for (i=1; i<=pagination.last; i++) {
                        var el = document.createElement('a');
                        el.href = "#";
                        el.innerHTML = i;

                        if (i===pagination.current) {
                            el.className = 'on';
                        } else {
                            el.onclick = (function(i) {
                                return function() {
                                    pagination.gotoPage(i);
                                }
                            })(i);
                        }

                        fragment.appendChild(el);
                    }
                    paginationEl.appendChild(fragment);
                }

            

            // 검색결과 목록의 자식 Element를 제거하는 함수입니다
            function removeAllChildNods(el) {   
                while (el.hasChildNodes()) {
                    el.removeChild (el.lastChild);
                }
            }
			
            


            </script>


            <!-- 컨테이너 -->
         
        <div id="info" class="info">
            <div class="d-infobar" id="infobar">
                <div class="info_header">
                    <ion-icon name="close-outline" class="info__toggle" id="infobtn" onclick="showinfo()"></ion-icon>
                    <h3 class="p_name" name="parking_name"></h3>
                </div>
                <div class="info_wrap">
                    <div class="info_content">
                        <div>
                            <span>공석 개수</span>
                            <span class="count" name="parking_number"></span>
                        </div>
                        <div>
                            <ion-icon name="location-outline"></ion-icon>
                            <span class="p_address" name="parking_address" ></span>
                        </div>
                        <div>
                            <ion-icon name="call-outline"></ion-icon>
                            <span class="p_phone" name="parking_phone"></span>
                        </div>
                        <div>
                            <ion-icon name="alarm-outline"></ion-icon>
                            <span class="p_time" name="parking_runtime"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="community">
                        <section class="mb-5">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="community_wrap">
                                        <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                        <button onclick="" id="register" class="register">등록</button>
                                    </div>
                                    <div class="comment_wrap">
                                        <!-- Comment with nested comments -->
                                        <div class="d-flex mb-4">
                                            <!-- Parent comment -->
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">익명1</div>
                                                지금 주차장 공사중이어서 사용할 수가 없어요
                                                <p class="date" name="date">2022.05.25 14:23</p>
                                                <!-- Child comment 1 -->
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                    <div class="ms-3">
                                                        <div class="fw-bold">익명2</div>
                                                        오!! 가려고 했는데 좋은 정보 감사합니다~~
                                                        <p class="date" name="date">2022.05.25 14:30</p>
                                                    </div>
                                                </div>
                                                <!-- Child comment 2 -->
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                    <div class="ms-3">
                                                        <div class="fw-bold">익명3</div>
                                                        지금은 공사 다 끝나서 사용 가능해요!!!!
                                                        <p class="date" name="date">2022.05.27 09:02</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single comment -->
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">익명5</div>
                                                이 주차장은 다 좋은데 주차 자리가 너무 좁아서 항상 주차하기가 너무 힘들어요..ㅠㅠㅠ
                                                <p class="date" name="date">2022.05.26 21:06</p>
                                            </div>
                                        </div>
                                    </div> 
                                   
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- IONICONS -->
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- JS -->
    <script src="js/main.js"></script>

<script>
// /* EXPANDER MENU */
// const showMenu = (navbarId, toggleId) => {
//     const navbar = document.getElementById(navbarId),
//           toggle = document.getElementById(toggleId)
//     if( toggle && navbar ) {
//         toggle.addEventListener('click', ()=>{
//             navbar.classList.toggle('expander');
//         })
//     }
// }
// showMenu('navbar', 'nav-toggle')
// showMenu('navbar', 'nav-close')   
 function showinfo(idx){
    
    //ajax 
    $.ajax({

        type : 'GET',

        url : 'selectone.php',

        data : {index: idx},

        error : function(){

           

        },

        success : function(result){
            var resultParse = JSON.parse(result);
            document.querySelector("#infobar > div.info_header > h3").innerHTML = resultParse[0].name;
            document.querySelector("#infobar > div.info_wrap > div.info_content > div:nth-child(1) > span.count").innerHTML = resultParse[0].number;
            document.querySelector("#infobar > div.info_wrap > div.info_content > div:nth-child(2) > span").innerHTML = resultParse[0].address;
            document.querySelector("#infobar > div.info_wrap > div.info_content > div:nth-child(3) > span").innerHTML = resultParse[0].phone;
            document.querySelector("#infobar > div.info_wrap > div.info_content > div:nth-child(4) > span").innerHTML = resultParse[0].runtime;
            

        }

        });


    const info = document.getElementById('info');
    info.classList.toggle('info_visible');
    info.classList.toggle('info');
    

    
    }
// function showpopup(){
//     const menu_wrap = document.getElementById('menu_wrap');
//     const search = document.getElementById('menu');
//     const info = document.getElementById('info');
//     menu_wrap.classList.toggle('menu_wrap');
//     menu_wrap.classList.toggle('menu-wrap-visible');
//     search.classList.toggle('menu');
//     search.classList.toggle('menu_visible');
// }

// /* LINK ACTIVE */
// const linkColor = document.querySelectorAll('.nav__link')
// function colorLink() {
//     linkColor.forEach(l=> l.classList.remove('active'))
//     this.classList.add('active')
// }
// linkColor.forEach(l=> l.addEventListener('click', colorLink))

// /* COLLAPSE MENU */
// const linkCollapse = document.getElementsByClassName('collapse__link')
// var i

// for(i=0;i<linkCollapse.length;i++) {
//     linkCollapse[i].addEventListener('click', function(){
//         const collapseMenu = this.nextElementSibling
//         collapseMenu.classList.toggle('showCollapse')

//         const rotate = collapseMenu.previousElementSibling
//         rotate.classList.toggle('rotate')
//     });
// }

</script>

</body>

</html>
