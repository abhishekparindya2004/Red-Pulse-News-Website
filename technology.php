<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RedPulse — Technology</title>
  <link rel="stylesheet" href="style.css"/>
    <link rel="icon" href="images/logo.png">
</head>
<body>

<div class="topbar">
  <div class="wrap">
    <div class="left">
      <span class="badge"><span class="dot"></span> LIVE</span>
      <span>Technology Desk • Verified Updates</span>
    </div>
    <div class="right">
      <a href="#" onclick="RP_UI.openAuth('signin')">Sign In</a>
    </div>
  </div>
</div>

<header class="site-header">
  <div class="wrap">
    <div class="brand">
      <div class="logo-icon">RP</div>
      <div>
        <div class="logo-text">RedPulse</div>
        <div class="small">Technology</div>
      </div>
    </div>

    <nav class="nav">
      <a href="index.php">Home</a>
      <a href="world.php">World</a>
      <a href="technology.php" class="active">Technology</a>
      <a href="sports.php">Sports</a>
      <a href="contact.php">Contact</a>
    </nav>

    <div class="header-actions">
      <div class="search" title="Search within this section page">
        <span style="font-weight:900;opacity:.7">⌕</span>
        <input id="siteSearch" type="search" placeholder="Search Technology stories..."/>
      </div>

      <div id="signedOutActions" style="display:flex;gap:10px;align-items:center">
        <button class="ghost-btn" onclick="RP_UI.openAuth('signin')">Sign In</button>
        <button class="primary-btn" onclick="RP_UI.openAuth('signup')">Create Account</button>
      </div>

      <div id="signedInActions" style="display:none;gap:10px;align-items:center">
        <span class="badge" style="color:#fff">Hi, <span id="whoLabel">User</span> 👋</span>
        <button class="primary-btn" onclick="RP_UI.logout()">Logout</button>
      </div>
    </div>
  </div>
</header>

<div class="ticker">
  <div class="wrap">
    <div class="label">TECHNOLOGY</div>
    <div class="scroll">
      <span>Technology desk: practical tech news • Security, AI, software, and trends with real examples • Use search to filter stories •</span>
    </div>
  </div>
</div>

<div class="container">
  <div class="grid">

    <main class="card pad">
      <div class="h">
        <h2>Technology desk: practical tech news</h2>
        <div class="small">Security, AI, software, and trends with real examples</div>
      </div>

      <div class="news-grid">
        <article class="news-card" data-search="artificial intelligence ai summit sets standards for safety and governance the key terms you must know models risk tiers audits transparency">
          <img src="images/t1.png" alt="">
          <div class="body">
            <span class="tag">Artificial Intelligence</span>
            <h3>AI summit sets standards for safety and governance</h3>
            <p>The key terms you must know: models, risk tiers, audits, transparency.</p>
            <div class="meta-row"><span>5 min</span><a class="readmore" href="index.php#latest">More →</a></div>
          </div>
        </article>

        <article class="news-card" data-search="cybersecurity threats rising top 5 controls that stop most attacks mfa patching backups least privilege and logging in plain language">
          <img src="images/t2.png" alt="">
          <div class="body">
            <span class="tag">Cybersecurity</span>
            <h3>Threats rising: top 5 controls that stop most attacks</h3>
            <p>MFA, patching, backups, least privilege, and logging — in plain language.</p>
            <div class="meta-row"><span>5 min</span><a class="readmore" href="index.php">More →</a></div>
          </div>
        </article>

        <article class="news-card" data-search="software why your login was failing common frontend mistakes missing validation no persistent storage and no session state fixed in app js">
          <img src="images/t3.png" alt="">
          <div class="body">
            <span class="tag">Software</span>
            <h3>Why your login was failing: common frontend mistakes</h3>
            <p>Missing validation, no persistent storage, and no session state — fixed in app.js.</p>
            <div class="meta-row"><span>5 min</span><a class="readmore" href="index.php">More →</a></div>
          </div>
        </article>
      </div>
    </main>

    
    <aside class="card">
      <div class="widget">
        <div class="h">
          <h3>Most Read</h3>
          <span class="small">Trending</span>
        </div>

        <div class="list">
          <div>
            <a href="world.php">Global leaders convene for climate summit: what changed since last year</a>
            <div class="li">A quick breakdown of promises, funding, and deadlines.</div>
          </div>
          <div>
            <a href="sports.php">Finals night hits record viewership across multiple regions</a>
            <div class="li">Highlights, tactics, and moments that went viral.</div>
          </div>
          <div>
            <a href="index.php#latest">New cyber threats: what small teams should do first</a>
            <div class="li">Simple checklist: MFA, backups, patching, monitoring.</div>
          </div>
        </div>
      </div>
    </aside>

  </div>
</div>

<footer>
  <div class="wrap">
    <div>
      <h4>About RedPulse</h4>
        </div>
    <div>
      <h4>Sections</h4>
      <p>Home • World • Technology • Sports</p>
    </div>
    <div>
      <h4>Support</h4>
      <p>Contact us for feedback and issues. This is a front-end demo.</p>
    </div>
  </div>
  <div class="bottom">
    <span>© 2026 RedPulse PVT & LTD</span>
    <span>Section: Technology</span>
  </div>
</footer>


<div class="modal" id="authModal" aria-hidden="true">
  <div class="panel" role="dialog" aria-modal="true">
    <div class="side">
      <div class="inner">
        <h2>Account</h2>
        <p>Sign in to save stories. Demo-only storage (browser LocalStorage).</p>
        <div style="margin-top:14px" class="small">Password rule: 6+ chars, letters + numbers.</div>
      </div>
    </div>

    <div class="content">
      <div class="top">
        <div>
          <div style="font-weight:1000;font-size:16px">Sign in / Create</div>
          <div class="small">Works on every page</div>
        </div>
        <button id="authClose" class="close" aria-label="Close">✕</button>
      </div>

      <div id="authInfo" class="ok"></div>

      <div class="tabs">
        <button class="tab active" data-tab="signin">Sign In</button>
        <button class="tab" data-tab="signup">Create Account</button>
      </div>

      <div id="signinPanel">
        <div id="signinErr" class="err"></div>
        <form id="signinForm" class="form">
          <div>
            <label>Email</label>
            <input id="siEmail" type="email" required placeholder="you@example.com"/>
          </div>
          <div>
            <label>Password</label>
            <input id="siPassword" type="password" required placeholder="••••••••"/>
          </div>
          <div class="help">
            <a href="#" id="forgotLink">Forgot password?</a>
            <span class="small">Demo</span>
          </div>
          <button class="primary-btn" type="submit">Sign In</button>
        </form>
      </div>

      <div id="signupPanel" class="hide">
        <div id="signupErr" class="err"></div>
        <form id="signupForm" class="form">
          <div>
            <label>Full name</label>
            <input id="suName" type="text" required placeholder="Your name"/>
          </div>
          <div>
            <label>Email</label>
            <input id="suEmail" type="email" required placeholder="you@example.com"/>
          </div>
          <div class="row2">
            <div>
              <label>Password</label>
              <input id="suPassword" type="password" required placeholder="letters + numbers"/>
            </div>
            <div>
              <label>Confirm</label>
              <input id="suPassword2" type="password" required placeholder="repeat password"/>
            </div>
          </div>
          <button class="primary-btn" type="submit">Create Account</button>
          <div class="small">Demo terms: stored only in this browser.</div>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="app.js"></script>
</body>
</html>