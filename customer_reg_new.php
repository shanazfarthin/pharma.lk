<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Registration</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --navy: #0f2744;
    --navy-mid: #1a3a5c;
    --navy-light: #2a5080;
    --accent: #2e86de;
    --accent-light: #e8f2fd;
    --success: #1e8449;
    --success-bg: #eafaf1;
    --danger: #c0392b;
    --danger-bg: #fdf2f2;
    --warning: #d68910;
    --warning-bg: #fef9e7;
    --border: #d5dde8;
    --border-focus: #2e86de;
    --bg-page: #f0f4f9;
    --bg-card: #ffffff;
    --bg-section: #f7f9fc;
    --text-primary: #0f2744;
    --text-secondary: #4a6080;
    --text-muted: #8da0b5;
    --font-main: 'DM Sans', sans-serif;
    --font-display: 'DM Serif Display', serif;
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 16px;
    --shadow-card: 0 4px 24px rgba(15,39,68,0.10), 0 1px 4px rgba(15,39,68,0.06);
    --shadow-input: 0 0 0 3px rgba(46,134,222,0.18);
  }

  body {
    font-family: var(--font-main);
    background: var(--bg-page);
    min-height: 100vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 40px 16px;
    color: var(--text-primary);
  }

  .page-wrapper {
    width: 100%;
    max-width: 820px;
  }

  /* Page Header */
  .page-header {
    text-align: center;
    margin-bottom: 32px;
  }
  .page-header .brand {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
  }
  .brand-icon {
    width: 44px; height: 44px;
    background: var(--navy);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
  }
  .brand-icon svg { width: 22px; height: 22px; fill: none; stroke: #fff; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  .brand-name {
    font-family: var(--font-display);
    font-size: 22px;
    color: var(--navy);
    letter-spacing: -0.02em;
  }
  .page-header h1 {
    font-family: var(--font-display);
    font-size: 34px;
    color: var(--navy);
    letter-spacing: -0.03em;
    line-height: 1.15;
    margin-bottom: 8px;
  }
  .page-header p {
    font-size: 15px;
    color: var(--text-secondary);
  }

  /* Card */
  .card {
    background: var(--bg-card);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
    overflow: hidden;
  }

  /* Card header */
  .card-header {
    background: var(--navy);
    padding: 20px 36px;
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .card-header-icon {
    width: 42px; height: 42px;
    background: rgba(255,255,255,0.12);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .card-header-icon svg { width: 22px; height: 22px; }
  .card-header-title { font-size: 18px; font-weight: 600; color: #fff; font-family: var(--font-display); letter-spacing: -0.01em; }
  .card-header-sub { font-size: 12px; color: rgba(255,255,255,0.55); margin-top: 2px; }

  /* Form body */
  .form-body { padding: 32px 36px; }

  /* Section */
  .section { margin-bottom: 28px; }
  .section-head {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 1.5px solid var(--bg-section);
  }
  .section-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    background: var(--accent-light);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .section-icon svg { width: 16px; height: 16px; fill: none; stroke: var(--accent); stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  .section-title { font-size: 13px; font-weight: 600; color: var(--navy); text-transform: uppercase; letter-spacing: 0.06em; }

  /* Grid */
  .grid { display: grid; gap: 16px; }
  .g2 { grid-template-columns: 1fr 1fr; }
  .g3 { grid-template-columns: 1fr 1fr 1fr; }
  .g1 { grid-template-columns: 1fr; }

  /* Field */
  .field { display: flex; flex-direction: column; gap: 6px; }
  .field label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-secondary);
    letter-spacing: 0.03em;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .req { color: var(--danger); font-size: 13px; line-height: 1; }
  .auto-badge {
    font-size: 10px;
    background: var(--accent-light);
    color: var(--accent);
    border-radius: 4px;
    padding: 1px 6px;
    font-weight: 500;
    margin-left: 4px;
  }

  input, select {
    font-family: var(--font-main);
    font-size: 14px;
    color: var(--text-primary);
    background: var(--bg-card);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    height: 42px;
    padding: 0 12px;
    width: 100%;
    outline: none;
    transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
    appearance: none;
  }
  input::placeholder { color: var(--text-muted); font-size: 13px; }
  input:focus, select:focus {
    border-color: var(--border-focus);
    box-shadow: var(--shadow-input);
  }
  input.readonly-f {
    background: var(--bg-section);
    color: var(--text-secondary);
    cursor: not-allowed;
    font-weight: 500;
  }
  input.valid { border-color: var(--success); background: var(--success-bg); }
  input.invalid, select.invalid { border-color: var(--danger); background: var(--danger-bg); }
  select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='none' stroke='%238da0b5' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round' d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 32px; cursor: pointer; }

  .hint { font-size: 11px; color: var(--text-muted); }
  .errmsg { font-size: 11px; color: var(--danger); display: none; align-items: center; gap: 4px; }
  .errmsg.show { display: flex; }
  .errmsg::before { content: '⚠'; font-size: 10px; }

  /* Password strength */
  .pw-bar-wrap { display: flex; gap: 3px; margin-top: 4px; }
  .pw-bar { height: 3px; flex: 1; border-radius: 2px; background: var(--border); transition: background 0.3s; }
  .pw-label { font-size: 11px; color: var(--text-muted); margin-top: 2px; }

  /* Customer ID display */
  .cid-display {
    display: none;
    align-items: center;
    gap: 8px;
    background: var(--accent-light);
    border: 1.5px solid var(--accent);
    border-radius: var(--radius-sm);
    padding: 8px 14px;
    margin-top: 4px;
  }
  .cid-display.show { display: flex; }
  .cid-display .cid-val { font-size: 15px; font-weight: 600; color: var(--accent); font-family: monospace; letter-spacing: 0.05em; }
  .cid-display .cid-hint { font-size: 11px; color: var(--text-secondary); }

  /* Success banner */
  .success-banner {
    display: none;
    background: var(--success-bg);
    border: 1.5px solid var(--success);
    border-radius: var(--radius-md);
    padding: 16px 20px;
    margin-bottom: 24px;
    align-items: flex-start;
    gap: 14px;
    animation: slideIn 0.4s ease;
  }
  .success-banner.show { display: flex; }
  .success-icon {
    width: 36px; height: 36px; flex-shrink: 0;
    background: var(--success);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
  }
  .success-icon svg { width: 18px; height: 18px; fill: none; stroke: #fff; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }
  .success-text h3 { font-size: 15px; font-weight: 600; color: var(--success); margin-bottom: 4px; }
  .success-text p { font-size: 13px; color: #2d6a4f; }

  /* Footer */
  .form-footer {
    background: var(--bg-section);
    border-top: 1.5px solid var(--border);
    padding: 20px 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .footer-note { font-size: 12px; color: var(--text-muted); }
  .footer-note strong { color: var(--danger); }
  .btn-group { display: flex; gap: 10px; }

  .btn {
    font-family: var(--font-main);
    font-size: 14px;
    font-weight: 500;
    height: 42px;
    padding: 0 24px;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: all 0.18s;
    border: none;
    display: inline-flex; align-items: center; gap: 8px;
  }
  .btn-ghost {
    background: transparent;
    border: 1.5px solid var(--border);
    color: var(--text-secondary);
  }
  .btn-ghost:hover { background: var(--bg-page); border-color: var(--navy-light); color: var(--navy); }
  .btn-primary {
    background: var(--navy);
    color: #fff;
  }
  .btn-primary:hover { background: var(--navy-mid); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(15,39,68,0.25); }
  .btn-primary:active { transform: translateY(0); }
  .btn svg { width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

  @keyframes slideIn {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @media (max-width: 640px) {
    .form-body { padding: 20px 16px; }
    .form-footer { flex-direction: column; gap: 14px; align-items: flex-start; }
    .g2, .g3 { grid-template-columns: 1fr; }
    .page-header h1 { font-size: 26px; }
  }
</style>
</head>
<body>


<form action="" method="POST" onsubmit="return validateForm()">
<div class="page-wrapper">

  <div class="page-header">
    <div class="brand">
      <div class="brand-icon">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </div>
      <span class="brand-name">CRM Portal</span>
    </div>
    <h1>Customer Registration</h1>
    <p>Create a new customer account. Fields marked <strong style="color:var(--danger)">*</strong> are required.</p>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </div>
      <div>
        <div class="card-header-title">Personal Details</div>
        <div class="card-header-sub">Complete all fields to register a new customer</div>
      </div>
    </div>
    <div class="form-body" >

      <!-- Success Banner -->
      <div class="success-banner" id="successBanner">
        <div class="success-icon">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div class="success-text">
          <h3>Registration Successful!</h3>
          <p id="successMsg">Your customer account has been created. Please keep your Customer ID safe.</p>
        </div>
      </div>

      <!-- SECTION 1: Account (hidden) -->

      <div class="cid-display" id="cidDisplay" style="display:none">
        <div class="cid-val" id="cidVal" ></div>
      </div>

      <!-- SECTION 2: Personal -->
      <div class="section">
        <div class="section-head">
          <div class="section-icon">
            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </div>
          <span class="section-title">Personal Details</span>
        </div>
        <div class="grid g3" style="margin-bottom:16px">
          <div class="field">
            <label>First Name <span class="req">*</span></label>
            <input type="text" id="firstName" name="f_name" placeholder="e.g. John" oninput="syncName()">
            <span class="errmsg" id="err-firstName">First name is required</span>
          </div>
          <div class="field">
            <label>Middle Name</label>
            <input type="text" id="middleName" name="m_name" placeholder="Optional" oninput="syncName()">
          </div>
          <div class="field">
            <label>Surname <span class="req">*</span></label>
            <input type="text" id="surname" name="s_name" placeholder="e.g. Smith" oninput="syncName()">
            <span class="errmsg" id="err-surname">Surname is required</span>
          </div>
        </div>
        <div class="grid g2" style="margin-bottom:16px">
          <div class="field">
            <label>Full Customer Name <span class="auto-badge">Auto-filled</span></label>
            <input type="text" id="customerName" name="fl_name" class="readonly-f" readonly placeholder="Auto-composed from name fields">
            <span class="hint">Composed from First + Middle + Surname</span>
          </div>
          <div class="field">
            <label>Gender <span class="req">*</span></label>
            <select id="gender" name="gender">
              <option value="">— Select gender —</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Non-binary">Non-binary</option>
              <option value="Other">Other</option>
              <option value="Prefer not to say">Prefer not to say</option>
            </select>
            <span class="errmsg" id="err-gender">Please select a gender</span>
          </div>
        </div>
        <div class="grid g2">
          <div class="field">
            <label>Date of Birth <span class="req">*</span></label>
            <input type="date" id="dob" name="DOB" onchange="calcAge()" max="">
            <span class="errmsg" id="err-dob">Date of birth is required</span>
          </div>
          <div class="field">
            <label>Age <span class="auto-badge">Auto-calculated</span></label>
            <input type="text" id="age" name="age" class="readonly-f" readonly placeholder="Calculated from DOB">
          </div>
        </div>
      </div>

      <!-- SECTION 3: Contact -->
      <div class="section">
        <div class="section-head">
          <div class="section-icon">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <span class="section-title">Contact & Location</span>
        </div>
        <div class="grid g1" style="margin-bottom:16px">
          <div class="field">
            <label>Address <span class="req">*</span></label>
            <input type="text" id="address" name="address" placeholder="e.g. 123 Main Street, Apt 4B">
            <span class="errmsg" id="err-address">Address is required</span>
          </div>
        </div>
        <div class="grid g2">
          <div class="field">
            <label>City <span class="req">*</span></label>
            <input type="text" id="city" name="city" placeholder="e.g. Colombo">
            <span class="errmsg" id="err-city">City is required</span>
          </div>
          <div class="field">
            <label>Contact No. <span class="req">*</span></label>
            <input type="tel" id="contactNo" name="con_no" placeholder="e.g. 0771234567" oninput="numOnly(this,15)">
            <span class="errmsg" id="err-contactNo">Enter a valid contact number (min 7 digits)</span>
          </div>
        </div>
      </div>

      <!-- SECTION 4: Security -->
      <div class="section" style="margin-bottom:0">
        <div class="section-head">
          <div class="section-icon">
            <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          </div>
          <span class="section-title">Account Security</span>
        </div>
        <div class="grid g1" style="margin-bottom:16px">
          <div class="field">
            <label>Email Address <span class="req">*</span></label>
            <input type="email" id="email" name="email" placeholder="e.g. john.smith@example.com" oninput="liveEmail()">
            <span class="errmsg" id="err-email">Please enter a valid email address (e.g. user@domain.com)</span>
          </div>
        </div>
        <div class="grid g2">
          <div class="field">
            <label>Password <span class="req">*</span></label>
            <input type="password" id="password" name="pass"  placeholder="Minimum 8 characters" oninput="pwStrength();matchPw()">
            <div class="pw-bar-wrap">
              <div class="pw-bar" id="pwb1"></div>
              <div class="pw-bar" id="pwb2"></div>
              <div class="pw-bar" id="pwb3"></div>
              <div class="pw-bar" id="pwb4"></div>
            </div>
            <span class="pw-label" id="pwLabel"></span>
            <span class="errmsg" id="err-password">Password must be at least 8 characters</span>
          </div>
          <div class="field">
            <label>Re-enter Password <span class="req">*</span></label>
            <input type="password" id="rePassword" placeholder="Confirm your password" oninput="matchPw()">
            <span class="errmsg" id="err-rePassword">Passwords do not match</span>
          </div>
        </div>
      </div>

    </div><!-- /form-body -->

    <div class="form-footer">
      <span class="footer-note"><strong>*</strong> Required fields</span>
      <div class="btn-group">
        <button class="btn btn-ghost" onclick="resetForm()">
          <svg viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.51"/></svg>
          Reset
        </button>
        <button class="btn btn-primary" onclick="submitForm()">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><polyline points="16 3 21 8 16 13"/><line x1="21" y1="8" x2="9" y2="8"/></svg>
          Register Customer
        </button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  // Set max DOB to today
  document.getElementById('dob').max = new Date().toISOString().split('T')[0];

  // Incremental Customer ID counter (persisted in localStorage)
  function getNextCustomerId() {
    const current = parseInt(localStorage.getItem('pcus_counter') || '0', 10);
    const next = current + 1;
    localStorage.setItem('pcus_counter', next);
    return 'PCUS' + String(next).padStart(4, '0');
  }

  function v(id) { return document.getElementById(id).value.trim(); }

  function syncName() {
    const f = v('firstName'), m = v('middleName'), s = v('surname');
    document.getElementById('customerName').value = [f, m, s].filter(Boolean).join(' ');
  }

  function numOnly(el, max) {
    el.value = el.value.replace(/\D/g, '').slice(0, max);
  }

  function calcAge() {
    const dob = document.getElementById('dob').value;
    if (!dob) { document.getElementById('age').value = ''; return; }
    const birthDate = new Date(dob);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
    document.getElementById('age').value = (age >= 0 && age < 130) ? age + ' years' : '';
    markField('dob', false);
  }

  function liveEmail() {
    const val = v('email');
    if (!val) { resetField('email'); return; }
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(val);
    mark('email', !ok);
    if (ok) document.getElementById('email').classList.add('valid');
  }

  function pwStrength() {
    const pw = document.getElementById('password').value;
    const bars = [document.getElementById('pwb1'), document.getElementById('pwb2'), document.getElementById('pwb3'), document.getElementById('pwb4')];
    const label = document.getElementById('pwLabel');
    bars.forEach(b => b.style.background = 'var(--border)');
    if (!pw) { label.textContent = ''; return; }
    let score = 0;
    if (pw.length >= 8) score++;
    if (pw.length >= 12) score++;
    if (/[A-Z]/.test(pw) && /[0-9]/.test(pw)) score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;
    const colors = ['#e74c3c', '#e67e22', '#2ecc71', '#1a8a4a'];
    const labels = ['Weak', 'Fair', 'Strong', 'Very strong'];
    for (let i = 0; i < score; i++) bars[i].style.background = colors[score - 1];
    label.textContent = score > 0 ? 'Strength: ' + labels[score - 1] : '';
    label.style.color = colors[score - 1] || 'var(--text-muted)';
  }

  function matchPw() {
    const pw = v('password'), rp = v('rePassword');
    if (!rp) { resetField('rePassword'); return; }
    const mismatch = pw !== rp;
    mark('rePassword', mismatch);
    if (!mismatch) document.getElementById('rePassword').classList.add('valid');
  }

  function mark(id, invalid) {
    const el = document.getElementById(id);
    el.classList.toggle('invalid', invalid);
    el.classList.toggle('valid', !invalid);
    showErr('err-' + id, invalid);
  }

  function markField(id, invalid) { mark(id, invalid); }

  function resetField(id) {
    const el = document.getElementById(id);
    el.classList.remove('invalid', 'valid');
    showErr('err-' + id, false);
  }

  function showErr(id, show) {
    const el = document.getElementById(id);
    if (el) el.classList.toggle('show', show);
  }

  function updateSteps() {}

  function submitForm() {
    let ok = true;

    const required = [
      { id: 'firstName', test: val => val.length > 0 },
      { id: 'surname', test: val => val.length > 0 },
      { id: 'gender', test: val => val.length > 0 },
      { id: 'dob', test: val => val.length > 0 },
      { id: 'address', test: val => val.length > 0 },
      { id: 'city', test: val => val.length > 0 },
      { id: 'contactNo', test: val => val.replace(/\D/g,'').length >= 7 },
      { id: 'email', test: val => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(val) },
      { id: 'password', test: val => val.length >= 8 },
      { id: 'rePassword', test: val => val === document.getElementById('password').value && val.length > 0 },
    ];

    required.forEach(r => {
      const val = v(r.id);
      const invalid = !r.test(val);
      markField(r.id, invalid);
      if (invalid) ok = false;
    });

    if (!ok) {
      // scroll to first error
      const firstErr = document.querySelector('.invalid');
      if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    // Generate incremental Customer ID
    const cid = getNextCustomerId();

    document.getElementById('customerId').value = cid;
    document.getElementById('cidVal').textContent = cid;
    document.getElementById('cidDisplay').classList.add('show');

    const name = v('customerName') || (v('firstName') + ' ' + v('surname'));
    document.getElementById('successMsg').textContent =
      `Welcome, ${name}! Your Customer ID is ${cid}. Please keep this safe for future reference.`;
    document.getElementById('successBanner').classList.add('show');
    document.getElementById('successBanner').scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  function resetForm() {
    const fields = ['firstName','middleName','surname','customerName','gender','dob','age',
                    'address','city','contactNo','email','password','rePassword','customerId'];
    fields.forEach(id => {
      const el = document.getElementById(id);
      if (el) { el.value = ''; el.classList.remove('invalid','valid'); }
    });
    document.querySelectorAll('.errmsg').forEach(e => e.classList.remove('show'));
    document.getElementById('successBanner').classList.remove('show');
    document.getElementById('cidDisplay').classList.remove('show');
    document.getElementById('pwLabel').textContent = '';
    ['pwb1','pwb2','pwb3','pwb4'].forEach(id => {
      document.getElementById(id).style.background = 'var(--border)';
    });
    document.getElementById('step1').classList.add('active');
  }
</script>
</body>
</html>

<?php
include 'connection.php'; // calling DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cus_id = $_POST['cus_id'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $s_name = $_POST['s_name'];
    $fl_name = $_POST['fl_name'];
    $gender = $_POST['gender'];
    $DOB = $_POST['DOB'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $con_no = $_POST['con_no'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // secure password

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Insert query
    $sql = "INSERT INTO customer (
        cus_id, f_name, m_name, s_name, fl_name,
        gender, DOB, age, address, city,
        con_no, email, pass
    ) VALUES (
        '$cus_id', '$f_name', '$m_name', '$s_name', '$fl_name',
        '$gender', '$DOB', '$age', '$address', '$city',
        '$con_no', '$email', '$pass'
    )";

if (mysqli_query($conn, $sql)) {

    echo "<script>
            alert('Registration Successful!');
           
          </script>";

} else {

    echo "<script>
            alert('Error: " . mysqli_error($conn) . "');
            window.location.href='register.php';
          </script>";
}
    }

?>