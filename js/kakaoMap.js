function kaokaoMap(){
    var container = document.getElementById('map'); //지도를 표시할 div
    var options = {
        center: new kakao.maps.LatLng(37.45018273122386, 127.12991023339896), //지도의 중심좌표
        lelver: 3 //지도의 확대 레벨
    };

    var map = new kakao.maps.Map(container, options) // 지도 생성

    var marker = new kakao.maps.Marker({
        map: map, 
        position: new kakao.maps.LatLng(37.45518788653112, 127.13391987008788)
    });
    
    // 커스텀 오버레이에 표시할 컨텐츠 입니다
    // 커스텀 오버레이는 아래와 같이 사용자가 자유롭게 컨텐츠를 구성하고 이벤트를 제어할 수 있기 때문에
    // 별도의 이벤트 메소드를 제공하지 않습니다 
    var content = '<div class="wrap">' + 
                '    <div class="info">' + 
                '        <div class="title">' + 
                '            가천대학교 ai공학관' + 
                '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' + 
                '        </div>' + 
                '        <div class="body">' + 
                '            <div class="img">' +
                '                <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAyMTExMTVfMTI4%2FMDAxNjM2OTY4MDY3ODEz.-DQpq7-_2hh46jqUw7hRgcXvT8mnj3o7QoqRwMWAE_cg.pIJywVEDM1M-vcvyhjJHoHc5vE8Pw1ZO8iQMm35LUscg.PNG.moa4979%2F%25B0%25A1%25C3%25B5%25B4%25EB%25C7%25D0%25B1%25B3.png&type=sc960_832" width="73" height="70">' +
                '           </div>' + 
                '            <div class="desc">' + 
                '                <div class="ellipsis">경기 성남시 수정구 복정동 495</div>' + 
                '                <div class="jibun ellipsis"> 031-750-5114</div>' + 
                '                <div><a href="https://www.gachon.ac.kr/kor/index.do" target="_blank" class="link">홈페이지</a></div>' + 
                '            </div>' + 
                '        </div>' + 
                '    </div>' +    
                '</div>';
    
    // 마커 위에 커스텀오버레이를 표시합니다
    // 마커를 중심으로 커스텀 오버레이를 표시하기위해 CSS를 이용해 위치를 설정했습니다
    var overlay = new kakao.maps.CustomOverlay({
        content: content,
        map: map,
        position: marker.getPosition()       
    });
    
    // 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
    kakao.maps.event.addListener(marker, 'click', function() {
        overlay.setMap(map);
    });
    
    // 커스텀 오버레이를 닫기 위해 호출되는 함수입니다 
    function closeOverlay() {
        overlay.setMap(null);     
    }

    function panTo() {
        // 이동할 위도 경도 위치를 생성
        var moveLatLon = new kakao.map.LatLng(33.450580, 126.574942);
        map.panTo(moveLatLon);
    }

    //지도 확대 축소를 제어할 수 있는 줌 컨트롤을 생성
    var zoomControl = new kakao.maps.ZoomControl();
    map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);
};

$(function(){
    kaokaoMap();
})