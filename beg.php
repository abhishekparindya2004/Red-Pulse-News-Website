
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Welcome to RedPulse</title>
  <link rel="icon" href="images/logo.png">
<style>
  *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',system-ui,Arial,sans-serif}
  body,html{width:100%;height:100%;overflow:hidden;background:#c62828}
  .splash-container{
    width:100%;height:100%;
    display:flex;flex-direction:column;justify-content:center;align-items:center;
    color:#fff;position:relative;overflow:hidden
  }
  .news-icon{font-size:5rem;animation:pulse 2s infinite;margin-bottom:20px}
  @keyframes pulse{
    0%{transform:scale(1);opacity:.7}
    50%{transform:scale(1.2);opacity:1}
    100%{transform:scale(1);opacity:.7}
  }
  .welcome-text{
    font-size:2.35rem;font-weight:900;text-align:center;letter-spacing:2px;
    animation:typing 3s steps(25,end) forwards, blink .7s step-end infinite alternate;
    white-space:nowrap;overflow:hidden;border-right:3px solid #ffeb3b
  }
  @keyframes typing{from{width:0}to{width:25ch}}
  @keyframes blink{0%,100%{border-color:transparent}50%{border-color:#ffeb3b}}

  .sub{
    margin-top:16px;
    opacity:.95;
    letter-spacing:1px;
    font-size:14px;
    max-width:560px;
    text-align:center;
    line-height:1.6;
  }

  .progress{
    width:min(520px, 82vw);
    height:10px;
    background:rgba(255,255,255,.18);
    border-radius:999px;
    overflow:hidden;
    margin-top:22px;
    border:1px solid rgba(255,255,255,.22);
  }
  .bar{
    height:100%;
    width:0%;
    background:#ffeb3b;
    border-radius:999px;
    animation:fill 5s linear forwards;
  }
  @keyframes fill{to{width:100%}}

  .btn-row{
    position:absolute;
    bottom:18px;
    display:flex;
    gap:10px;
    align-items:center;
    justify-content:center;
    width:100%;
    padding:0 14px;
  }
  .btn{
    border:none;
    padding:10px 14px;
    border-radius:999px;
    font-weight:900;
    cursor:pointer;
  }
  .btn.primary{background:#ffeb3b;color:#7a0f0f}
  .btn.ghost{background:rgba(255,255,255,.16);color:#fff;border:1px solid rgba(255,255,255,.25)}
  .btn:hover{filter:brightness(.96)}

  .dots{position:absolute;width:100%;height:100%;top:0;left:0;overflow:hidden;z-index:0}
  .dot{
    position:absolute;width:10px;height:10px;background:#ffeb3b;border-radius:50%;
    animation:move 5s linear infinite
  }
  @keyframes move{
    0%{transform:translateY(100vh) translateX(0);opacity:0}
    50%{opacity:1}
    100%{transform:translateY(-10vh) translateX(100vw);opacity:0}
  }
  .foreground{position:relative;z-index:1}
</style>
</head>
<body>

<div class="splash-container">
  <div class="foreground">
    <div class="news-icon">📰</div>
    <div class="welcome-text">Welcome to RedPulse!</div>
    <div class="sub">CNN-style news layout + a mini Marketplace (e‑business). Sign in, add to cart, and checkout — all demo-ready.</div>
    <div class="progress"><div class="bar"></div></div>
  </div>

  <div class="btn-row foreground">
    <button class="btn ghost" onclick="skip()">Skip</button>
    <button class="btn primary" onclick="go()">Enter</button>
  </div>

  <div class="dots">
    <div class="dot" style="top:10%; left:5%; animation-duration:4s;"></div>
    <div class="dot" style="top:20%; left:15%; animation-duration:6s;"></div>
    <div class="dot" style="top:30%; left:25%; animation-duration:5s;"></div>
    <div class="dot" style="top:40%; left:35%; animation-duration:7s;"></div>
    <div class="dot" style="top:50%; left:45%; animation-duration:5s;"></div>
    <div class="dot" style="top:60%; left:55%; animation-duration:6s;"></div>
    <div class="dot" style="top:70%; left:65%; animation-duration:4s;"></div>
    <div class="dot" style="top:80%; left:75%; animation-duration:6s;"></div>
  </div>
</div>

<script>
  function go(){ window.location.href="index.php"; }
  function skip(){ window.location.href="index.php"; }
  setTimeout(go, 5200);
</script>

</body>
</html>
