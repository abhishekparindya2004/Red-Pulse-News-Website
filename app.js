/* RedPulse App JS: Auth + Search + Marketplace Cart (LocalStorage)
   Note: This is a frontend demo (no real backend). */

const RP = {
  usersKey: "rp_users_v1",
  sessionKey: "rp_session_v1",
  cartKey: "rp_cart_v1",
};

function $(sel, root=document){ return root.querySelector(sel); }
function $all(sel, root=document){ return Array.from(root.querySelectorAll(sel)); }

function loadUsers(){
  try{ return JSON.parse(localStorage.getItem(RP.usersKey) || "[]"); }catch(e){ return []; }
}
function saveUsers(users){
  localStorage.setItem(RP.usersKey, JSON.stringify(users));
}
function getSession(){
  try{ return JSON.parse(localStorage.getItem(RP.sessionKey) || "null"); }catch(e){ return null; }
}
function setSession(session){
  localStorage.setItem(RP.sessionKey, JSON.stringify(session));
}
function clearSession(){
  localStorage.removeItem(RP.sessionKey);
}

function normalizeEmail(email){ return (email || "").trim().toLowerCase(); }

function validatePassword(pw){
  // Simple rule: 6+ chars, at least 1 number, 1 letter (demo-friendly)
  if(!pw || pw.length < 6) return "Password must be at least 6 characters.";
  if(!/[A-Za-z]/.test(pw) || !/[0-9]/.test(pw)) return "Password should contain letters and numbers.";
  return null;
}

function ensureAuthModal(){
  const modal = $("#authModal");
  if(!modal) return;

  const tabs = $all("[data-tab]", modal);
  tabs.forEach(btn => btn.addEventListener("click", ()=> setAuthTab(btn.dataset.tab)));

  $("#authClose")?.addEventListener("click", closeAuth);
  modal.addEventListener("click", (e)=>{ if(e.target === modal) closeAuth(); });

  $("#signinForm")?.addEventListener("submit", onSignin);
  $("#signupForm")?.addEventListener("submit", onSignup);

  $("#forgotLink")?.addEventListener("click", (e)=>{
    e.preventDefault();
    showMsg("authInfo", "If this was a real system we'd email a reset link. For demo: create a new account or sign in.", true);
  });
}

function showMsg(id, msg, ok=false){
  const el = document.getElementById(id);
  if(!el) return;
  el.textContent = msg;
  el.style.display = "block";
  el.className = ok ? "ok" : "err";
}

function clearMsgs(){
  ["signinErr","signupErr","authInfo"].forEach(id=>{
    const el = document.getElementById(id);
    if(el) el.style.display = "none";
  });
}

function openAuth(tab="signin"){
  clearMsgs();
  const modal = $("#authModal");
  if(!modal) return;
  modal.classList.add("show");
  setAuthTab(tab);
}
function closeAuth(){
  const modal = $("#authModal");
  if(!modal) return;
  modal.classList.remove("show");
}

function setAuthTab(tab){
  const modal = $("#authModal");
  if(!modal) return;
  $all("[data-tab]", modal).forEach(b => b.classList.toggle("active", b.dataset.tab === tab));
  $("#signinPanel")?.classList.toggle("hide", tab !== "signin");
  $("#signupPanel")?.classList.toggle("hide", tab !== "signup");
}

function onSignup(e){
  e.preventDefault();
  clearMsgs();

  const name = $("#suName").value.trim();
  const email = normalizeEmail($("#suEmail").value);
  const pw = $("#suPassword").value;
  const pw2 = $("#suPassword2").value;

  if(!name) return showMsg("signupErr", "Please enter your full name.");
  if(!email || !email.includes("@")) return showMsg("signupErr", "Please enter a valid email address.");
  const pwErr = validatePassword(pw);
  if(pwErr) return showMsg("signupErr", pwErr);
  if(pw !== pw2) return showMsg("signupErr", "Passwords do not match.");

  const users = loadUsers();
  if(users.some(u => u.email === email)) return showMsg("signupErr", "This email already has an account. Please sign in.");

  const user = { id: cryptoRandomId(), name, email, pw }; // demo only
  users.push(user);
  saveUsers(users);

  setSession({ id: user.id, name: user.name, email: user.email, at: Date.now() });
  syncHeaderAuth();
  syncCartBadge();

  showMsg("authInfo", "Account created and signed in ✅", true);
  setTimeout(closeAuth, 850);
}

function onSignin(e){
  e.preventDefault();
  clearMsgs();

  const email = normalizeEmail($("#siEmail").value);
  const pw = $("#siPassword").value;

  if(!email || !email.includes("@")) return showMsg("signinErr", "Enter your email.");
  if(!pw) return showMsg("signinErr", "Enter your password.");

  const users = loadUsers();
  const user = users.find(u => u.email === email && u.pw === pw);
  if(!user) return showMsg("signinErr", "Wrong email or password.");

  setSession({ id: user.id, name: user.name, email: user.email, at: Date.now() });
  syncHeaderAuth();
  syncCartBadge();

  showMsg("authInfo", "Signed in ✅", true);
  setTimeout(closeAuth, 750);
}

function logout(){
  clearSession();
  syncHeaderAuth();
  closeDrawer();
  alert("Logged out successfully!");
}

function cryptoRandomId(){
  // simple random id
  return "u_" + Math.random().toString(16).slice(2) + "_" + Date.now().toString(16);
}

/* ====== Header auth state ====== */
function syncHeaderAuth(){
  const session = getSession();
  const signedOut = $("#signedOutActions");
  const signedIn = $("#signedInActions");
  const who = $("#whoLabel");
  if(!signedOut || !signedIn) return;

  if(session){
    signedOut.style.display = "none";
    signedIn.style.display = "flex";
    if(who) who.textContent = session.name.split(" ")[0];
  }else{
    signedOut.style.display = "flex";
    signedIn.style.display = "none";
    if(who) who.textContent = "";
  }
}

/* ====== Search (client-side filter on page cards) ====== */
function wireSearch(){
  const input = $("#siteSearch");
  if(!input) return;

  input.addEventListener("input", ()=>{
    const q = input.value.trim().toLowerCase();
    // find cards in common containers
    const cards = $all("[data-search]");
    cards.forEach(card=>{
      const text = (card.dataset.search || "").toLowerCase();
      card.style.display = (q === "" || text.includes(q)) ? "" : "none";
    });
  });
}

/* ====== Cart ====== */
function loadCart(){
  try{ return JSON.parse(localStorage.getItem(RP.cartKey) || "[]"); }catch(e){ return []; }
}
function saveCart(cart){
  localStorage.setItem(RP.cartKey, JSON.stringify(cart));
}
function cartTotal(cart){
  return cart.reduce((sum, i)=> sum + (i.price * i.qty), 0);
}
function syncCartBadge(){
  const cart = loadCart();
  const count = cart.reduce((s,i)=> s+i.qty, 0);
  const badge = $("#cartCount");
  if(badge) badge.textContent = count;
}

function addToCart(item){
  const cart = loadCart();
  const existing = cart.find(x=> x.id === item.id);
  if(existing) existing.qty += item.qty;
  else cart.push(item);
  saveCart(cart);
  syncCartBadge();
  openDrawer();
  renderCart();
}

function removeFromCart(id){
  const cart = loadCart().filter(i=> i.id !== id);
  saveCart(cart);
  syncCartBadge();
  renderCart();
}

function changeQty(id, delta){
  const cart = loadCart();
  const item = cart.find(i=> i.id === id);
  if(!item) return;
  item.qty = Math.max(1, item.qty + delta);
  saveCart(cart);
  syncCartBadge();
  renderCart();
}

function renderCart(){
  const wrap = $("#cartItems");
  const totalEl = $("#cartTotal");
  if(!wrap || !totalEl) return;

  const cart = loadCart();
  if(cart.length === 0){
    wrap.innerHTML = `<div class="small">Your cart is empty. Add something from the Marketplace.</div>`;
    totalEl.textContent = "LKR 0";
    return;
  }

  wrap.innerHTML = cart.map(i=>`
    <div class="cart-item">
      <img src="${i.img}" alt="">
      <div>
        <h4>${escapeHtml(i.title)}</h4>
        <div class="sub">LKR ${i.price.toLocaleString()} • Qty ${i.qty}</div>
        <div style="display:flex;gap:8px;margin-top:10px;flex-wrap:wrap">
          <button class="ghost-btn" onclick="RP_UI.changeQty('${i.id}',-1)">−</button>
          <button class="ghost-btn" onclick="RP_UI.changeQty('${i.id}',1)">+</button>
          <button class="ghost-btn" onclick="RP_UI.remove('${i.id}')">Remove</button>
        </div>
      </div>
    </div>
  `).join("");

  totalEl.textContent = "LKR " + cartTotal(cart).toLocaleString();
}

function escapeHtml(str){
  return (str||"").replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
}

/* Drawer UI helpers exposed globally (for inline onclick) */
const RP_UI = {
  openAuth,
  logout,
  addToCart,
  remove: removeFromCart,
  changeQty,
  openDrawer,
  closeDrawer,
  renderCart
};
window.RP_UI = RP_UI;

function openDrawer(){
  $("#cartOverlay")?.classList.add("show");
  $("#cartDrawer")?.classList.add("show");
}
function closeDrawer(){
  $("#cartOverlay")?.classList.remove("show");
  $("#cartDrawer")?.classList.remove("show");
}

function wireCart(){
  $("#cartBtn")?.addEventListener("click", ()=>{
    renderCart(); openDrawer();
  });
  $("#cartClose")?.addEventListener("click", closeDrawer);
  $("#cartOverlay")?.addEventListener("click", closeDrawer);

  $("#checkoutBtn")?.addEventListener("click", ()=>{
    const session = getSession();
    const cart = loadCart();
    if(cart.length === 0) return alert("Cart is empty.");
    if(!session) return openAuth("signin");
    alert("Checkout complete ✅ (demo). In a real system, we'd process payment + create an order.");
    localStorage.removeItem(RP.cartKey);
    syncCartBadge();
    renderCart();
    closeDrawer();
  });
}

/* ====== Welcome screen fade from original ====== */
function wireWelcome(){
  const ws = document.getElementById("welcome-screen");
  if(!ws) return;
  window.addEventListener("load", ()=>{
    setTimeout(()=> ws.classList.add("fade-out"), 4200);
  });
}

document.addEventListener("DOMContentLoaded", ()=>{
  ensureAuthModal();
  wireSearch();
  wireCart();
  wireWelcome();
  syncHeaderAuth();
  syncCartBadge();
});

/* Utility: allow hide class in auth panels */
document.addEventListener("DOMContentLoaded", ()=>{
  const style = document.createElement("style");
  style.textContent = `.hide{display:none !important}`;
  document.head.appendChild(style);
});
