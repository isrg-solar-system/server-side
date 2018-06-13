<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Admin - Solar Monitoring System</title>
  
  
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://dipu-bd.github.io/vue-weather-widget/dist/css/vue-weather-widget.css'>
<link rel='stylesheet prefetch' href='{{asset('css/back/master.css')}}'>
<link rel="stylesheet" href="{{asset('css/back/index.css')}}">

  
</head>

<body>

<div id="container">
  <div id="app">
    <div id="topbar" class="col-md-12">
      <div id="topheader">
        <div id="top-pic">
          <img src="https://www.dropbox.com/s/xg2xy54v8nqdqjm/CPUM-Logo.png?raw=1" alt="cpumeter-logo">
        </div>
        <div id="topheading">
          <h1>Solar<span>Panel</span></h1>
          <h2>Monitor System</h2>
        </div>
      </div>
      {{--<div id="date">--}}
        {{--<!--<a href="#">Help</a>-->--}}
        {{--<p id="pvm">下午9:15:43 | 2018/2/13</p>--}}
      {{--</div>--}}
    </div>

    <div class="col-md-12 row vertical-center">
      <div class="col-md-4">
        <div class="col-md-12 weather-box">

      <weather
          api-key="3652cbc5f3455e87c189d71e1062af57"
          hide-header=false
          latitude="24.144267"
          longitude="120.732028"
          language="en"
          units="uk">
      </weather>

        </div>
      </div>
      <div class="col-md-4">
        <div class="row ">
          <div class="col-md-6 first-line member-box" onclick="location.href = ('{{route('MemberIndex')}}')">
            <div class="member-icon"></div>
            <div class="member-word">Member Manager</div>
          </div>
          <div class="col-md-5 first-line second-box"></div>
          <div class="col-md-12 second-row-box website-box" onclick="location.href = ('{{route('SettingIndex')}}')">
            <div class="website-icon"></div>
            <div class="website-word">WebSite Setting</div>
          </div>
          <div class="col-md-12 second-row-box solar2-background">
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="col-md-12 third-row-box table-box" onclick="location.href = ('{{route('ReportIndex')}}')">
          <div class="table-icon"></div>
          <div class="table-word">Report View</div>
        </div>
        <div class="col-md-12 third-row-box download-box" onclick="location.href = ('{{route('DownloadIndex')}}')">
           <div class="download-icon"></div>
          <div class="download-word">Data Download</div>
        </div>
        <div class="col-md-12 third-row-box log-box" onclick="location.href = ('{{route('MemberIndex')}}')">
          <div class="log-icon"></div>
          <div class="log-word">System Log</div>
        </div>
        <div class="col-md-12 third-row-box" style="background-image: linear-gradient(-225deg, #9EFBD3 0%, #57E9F2 48%, #45D4FB 100%);">
        </div>
      </div>
      <div class="col-md-4">
        <div class="col-md-12 second-line-row-box solar-background">
        </div>
      </div>
      <div class="col-md-4">
        <div class="second-line-row-box  server-box">
          <div class="server-icon"></div>
            <serverstatus></serverstatus>
        </div>
      </div>
        <div class="col-md-4">
        <div class="col-md-12 second-line-third-box warm-box" onclick="location.href = ('{{route('WarningIndex')}}')">
         <div class="warm-icon"></div>
          <div class="warm-word">Warning Setting</div>
          </div>
        <div class="col-md-12 second-line-third-box warm-box" onclick="location.href = ('{{route('FrontIndex')}}')">
          <div class="home-icon"></div>
          <div class="warm-word">Back Home</div>
        </div>
        </div>
      </div>
   </div>
  </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js'></script>
<script  src="{{ asset('js/back.js')}}"></script>
</body>

</html>
