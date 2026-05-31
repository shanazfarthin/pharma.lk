<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Registration — PharmaCare</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --green-dark: #0d3d2b;
    --green-mid: #1a6645;
    --green-accent: #2eb87e;
    --green-light: #d4f5e5;
    --cream: #f7f5f0;
    --white: #ffffff;
    --text-dark: #111a15;
    --text-mid: #3d5447;
    --text-muted: #7a9486;
    --border: #c8ddd4;
    --border-focus: #2eb87e;
    --error: #c0392b;
    --error-bg: #fdf0ef;
    --shadow: 0 4px 24px rgba(13,61,43,0.10);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    min-height: 100vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 40px 16px 60px;
    position: relative;
    overflow-x: hidden;
  }

  /* Background decorative elements */
  body::before {
    content: '';
    position: fixed;
    top: -120px; right: -120px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(46,184,126,0.12) 0%, transparent 70%);
    pointer-events: none;
  }
  body::after {
    content: '';
    position: fixed;
    bottom: -80px; left: -80px;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(13,61,43,0.08) 0%, transparent 70%);
    pointer-events: none;
  }

  .card {
    background: var(--white);
    border-radius: 24px;
    box-shadow: var(--shadow);
    width: 100%;
    max-width: 760px;
    overflow: hidden;
    animation: slideUp 0.5s cubic-bezier(0.22,1,0.36,1) both;
  }

  @keyframes slideUp {
    from { opacity:0; transform: translateY(32px); }
    to   { opacity:1; transform: translateY(0); }
  }

  /* Header */
  .header {
    background: var(--green-dark);
    padding: 36px 48px 32px;
    position: relative;
    overflow: hidden;
  }
  .header::after {
    content: '';
    position: absolute;
    bottom: -40px; right: -40px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(46,184,126,0.15);
    pointer-events: none;
  }
  .header-top {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 18px;
  }
  .logo-mark {
    width: 44px; height: 44px;
    border-radius: 12px;
    background: var(--green-accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }
  .brand {
    font-family: 'DM Serif Display', serif;
    font-size: 22px;
    color: var(--white);
    letter-spacing: -0.3px;
  }
  .brand span { color: var(--green-accent); }
  .header h1 {
    font-family: 'DM Serif Display', serif;
    font-size: 30px;
    color: var(--white);
    font-weight: 400;
    letter-spacing: -0.5px;
    line-height: 1.2;
  }
  .header p {
    font-size: 14px;
    color: rgba(255,255,255,0.55);
    margin-top: 6px;
    font-weight: 300;
  }

  /* Form body */
  .form-body {
    padding: 40px 48px 48px;
  }

  /* Customer ID banner */
  .id-banner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--green-light);
    border: 1px solid #9fd8bf;
    border-radius: 12px;
    padding: 14px 20px;
    margin-bottom: 36px;
  }
  .id-banner-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--green-mid);
  }
  .id-banner-value {
    font-family: 'DM Serif Display', serif;
    font-size: 18px;
    color: var(--green-dark);
    letter-spacing: 1px;
  }
  .id-badge {
    font-size: 11px;
    background: var(--green-accent);
    color: var(--white);
    padding: 3px 10px;
    border-radius: 99px;
    font-weight: 500;
  }

  /* Section title */
  .section-title {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: var(--text-muted);
    margin-bottom: 16px;
    margin-top: 32px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border);
  }
  .section-title:first-of-type { margin-top: 0; }

  /* Grid */
  .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
  .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .grid-1 { display: grid; grid-template-columns: 1fr; gap: 16px; }
  .span-2 { grid-column: span 2; }

  /* Field */
  .field { display: flex; flex-direction: column; gap: 6px; }
  .field label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-mid);
    letter-spacing: 0.2px;
  }
  .field label .req { color: var(--green-accent); margin-left: 2px; }

  .field input,
  .field select {
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: var(--text-dark);
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: 10px;
    padding: 11px 14px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
  }
  .field input::placeholder { color: #b0c4bb; }
  .field input:focus,
  .field select:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(46,184,126,0.12);
    background: #fafefc;
  }
  .field input.error { border-color: var(--error); background: var(--error-bg); }
  .field input.error:focus { box-shadow: 0 0 0 3px rgba(192,57,43,0.10); }

  .field .hint {
    font-size: 11px;
    color: var(--text-muted);
    line-height: 1.4;
  }
  .field .err-msg {
    font-size: 11px;
    color: var(--error);
    display: none;
    align-items: center;
    gap: 4px;
  }
  .field .err-msg.show { display: flex; }

  /* Select wrapper */
  .select-wrap { position: relative; }
  .select-wrap::after {
    content: '▾';
    position: absolute;
    right: 14px; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 13px;
    pointer-events: none;
  }
  .select-wrap select { padding-right: 36px; cursor: pointer; }

  /* Password wrapper */
  .pw-wrap { position: relative; }
  .pw-wrap input { padding-right: 42px; }
  .pw-toggle {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    font-size: 16px;
    padding: 2px;
    line-height: 1;
  }
  .pw-toggle:hover { color: var(--green-mid); }

  /* Strength bar */
  .strength-bar {
    height: 3px;
    border-radius: 3px;
    background: var(--border);
    margin-top: 6px;
    overflow: hidden;
  }
  .strength-fill {
    height: 100%;
    border-radius: 3px;
    transition: width 0.3s, background 0.3s;
    width: 0%;
    background: var(--error);
  }
  .strength-label {
    font-size: 11px;
    color: var(--text-muted);
    margin-top: 4px;
  }

  /* Age auto-computed */
  .age-display {
    font-family: 'DM Serif Display', serif;
    font-size: 15px;
    color: var(--green-dark);
    background: var(--green-light);
    border: 1.5px solid #9fd8bf;
    border-radius: 10px;
    padding: 11px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .age-display .age-unit { font-size: 11px; font-family: 'DM Sans', sans-serif; color: var(--text-muted); }

  /* Submit */
  .footer-actions {
    margin-top: 40px;
    display: flex;
    gap: 12px;
    align-items: center;
    justify-content: flex-end;
  }
  .btn-reset {
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-muted);
    background: none;
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 12px 24px;
    cursor: pointer;
    transition: all 0.2s;
  }
  .btn-reset:hover { border-color: var(--text-muted); color: var(--text-dark); }

  .btn-submit {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    font-weight: 600;
    color: var(--white);
    background: var(--green-dark);
    border: none;
    border-radius: 12px;
    padding: 13px 36px;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    position: relative;
    overflow: hidden;
  }
  .btn-submit::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0);
    transition: background 0.2s;
  }
  .btn-submit:hover { background: var(--green-mid); }
  .btn-submit:active { transform: scale(0.98); }

  /* Success toast */
  #toast {
    position: fixed;
    bottom: 32px; left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: var(--green-dark);
    color: var(--white);
    font-size: 14px;
    font-weight: 500;
    padding: 14px 28px;
    border-radius: 50px;
    box-shadow: 0 8px 32px rgba(13,61,43,0.25);
    transition: transform 0.4s cubic-bezier(0.22,1,0.36,1), opacity 0.4s;
    opacity: 0;
    pointer-events: none;
    white-space: nowrap;
    z-index: 999;
  }
  #toast.show { transform: translateX(-50%) translateY(0); opacity: 1; }

  @media (max-width: 600px) {
    .header { padding: 28px 24px 24px; }
    .form-body { padding: 28px 24px 36px; }
    .grid-3, .grid-2 { grid-template-columns: 1fr; }
    .span-2 { grid-column: span 1; }
    .footer-actions { flex-direction: column-reverse; }
    .btn-submit, .btn-reset { width: 100%; text-align: center; }
  }
</style>
</head>
<body>

<div class="card">
  <!-- Header -->
  <div class="header">
    <div class="header-top">
      <div class="logo-mark">⚕</div>
      <div class="brand">Pharma<span>Care</span></div>
    </div>
    <h1>Customer Registration</h1>
    <p>Pharmacy Management System &mdash; New Patient Enrollment</p>
  </div>

  <!-- Form body -->
  <div class="form-body">
    <form id="regForm" novalidate>

      <!-- Customer ID -->
      <div class="id-banner">
        <div>
          <div class="id-banner-label">Customer ID</div>
          <div class="id-banner-value" id="custIdDisplay" name= "cus_id">PC-000001</div>
        </div>
        <span class="id-badge">Auto-generated</span>
      </div>

      <!-- Personal Information -->
      <div class="section-title">Personal Information</div>
      <div class="grid-3" style="margin-bottom:16px">
        <div class="field">
          <label>First Name <span class="req">*</span></label>
          <input type="text" id="firstName" placeholder="e.g. Ashan" autocomplete="given-name" name="f_name">
          <span class="err-msg" id="firstNameErr">⚠ First name is required</span>
        </div>
        <div class="field">
          <label>Middle Name</label>
          <input type="text" id="middleName" placeholder="Optional" autocomplete="additional-name" name="m_name">
        </div>
        <div class="field">
          <label>Surname <span class="req">*</span></label>
          <input type="text" id="surname" placeholder="e.g. Perera" autocomplete="family-name" name="s_name">
          <span class="err-msg" id="surnameErr">⚠ Surname is required</span>
        </div>
      </div>

      <div class="grid-2" style="margin-bottom:16px">
        <div class="field span-2">
          <label>Full Customer Name <span class="req">*</span></label>
          <input type="text" id="customerName" placeholder="Full legal name" autocomplete="name" name="fl_name">
          <span class="hint">Full name as it appears on official documents</span>
          <span class="err-msg" id="customerNameErr">⚠ Customer name is required</span>
        </div>
      </div>

      <div class="grid-3" style="margin-bottom:0">
        <div class="field">
          <label>Gender <span class="req">*</span></label>
          <div class="select-wrap">
            <select id="gender" name="gender">
              <option value="">Select gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
              <option value="Prefer not to say">Prefer not to say</option>
            </select>
          </div>
          <span class="err-msg" id="genderErr">⚠ Please select a gender</span>
        </div>
        <div class="field">
          <label>Date of Birth <span class="req">*</span></label>
          <input type="date" id="dob" max="" name="DOB">
          <span class="err-msg" id="dobErr">⚠ Date of birth is required</span>
        </div>
        <div class="field">
          <label>Age (computed)</label>
          <div class="age-display">
            <span id="ageValue" name="age">—</span>
            <span class="age-unit">years</span>
          </div>
        </div>
      </div>

      <!-- Contact & Address -->
      <div class="section-title">Contact & Address</div>
      <div class="grid-1" style="margin-bottom:16px">
        <div class="field">
          <label>Address <span class="req">*</span></label>
          <input type="text" id="address" placeholder="No. 12, Sample Road" autocomplete="street-address" name="address">
          <span class="err-msg" id="addressErr">⚠ Address is required</span>
        </div>
      </div>
      <div class="grid-2" style="margin-bottom:0">
        <div class="field">
          <label>City <span class="req">*</span></label>
          <input type="text" id="city" placeholder="e.g. Colombo" autocomplete="address-level2" name="city">
          <span class="err-msg" id="cityErr">⚠ City is required</span>
        </div>
        <div class="field">
          <label>Contact No. <span class="req">*</span></label>
          <input type="tel" id="contactNo" placeholder="e.g. 0771234567" inputmode="numeric" maxlength="15" autocomplete="tel" name="con_no">
          <span class="err-msg" id="contactNoErr">⚠ Valid contact number required (digits only)</span>
        </div>
      </div>

      <!-- Account -->
      <div class="section-title">Account Credentials</div>
      <div class="grid-2">
        <div class="field">
          <label>Email Address <span class="req">*</span></label>
          <input type="email" id="email" placeholder="e.g. ashan@email.com" autocomplete="email" name="email">
          <span class="err-msg" id="emailErr">⚠ Enter a valid email address</span>
        </div>
        <div class="field">
          <label>Password <span class="req">*</span></label>
          <div class="pw-wrap">
            <input type="password" id="password" placeholder="Min. 8 characters" autocomplete="new-password" name="pass">
            <button type="button" class="pw-toggle" id="pwToggle" title="Show/hide password">👁</button>
          </div>
          <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
          <div class="strength-label" id="strengthLabel">Enter a password</div>
          <span class="err-msg" id="passwordErr">⚠ Password must be at least 8 characters</span>
        </div>
      </div>

      <!-- Actions -->
      <div class="footer-actions">
        <button type="button" class="btn-reset" onclick="resetForm()">Clear form</button>
        <button type="submit" class="btn-submit">Register Customer →</button>
      </div>
    </form>
  </div>
</div>

<div id="toast">✓ Customer registered successfully!</div>

<script>
  // ── Auto-generate Customer ID ──────────────────────────────────────
  function genId() {
    const n = Math.floor(Math.random() * 999999) + 1;
    return 'PC-' + String(n).padStart(6, '0');
  }
  document.getElementById('custIdDisplay').textContent = genId();

  // ── Set DOB max to today ───────────────────────────────────────────
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('dob').setAttribute('max', today);

  // ── Auto-fill full name from parts ────────────────────────────────
  ['firstName','middleName','surname'].forEach(id => {
    document.getElementById(id).addEventListener('input', () => {
      const fn = document.getElementById('firstName').value.trim();
      const mn = document.getElementById('middleName').value.trim();
      const sn = document.getElementById('surname').value.trim();
      document.getElementById('customerName').value = [fn, mn, sn].filter(Boolean).join(' ');
    });
  });

  // ── Compute age from DOB ──────────────────────────────────────────
  document.getElementById('dob').addEventListener('change', function() {
    const dob = new Date(this.value);
    const now = new Date();
    let age = now.getFullYear() - dob.getFullYear();
    const m = now.getMonth() - dob.getMonth();
    if (m < 0 || (m === 0 && now.getDate() < dob.getDate())) age--;
    document.getElementById('ageValue').textContent = isNaN(age) || age < 0 ? '—' : age;
  });

  // ── Password visibility ───────────────────────────────────────────
  document.getElementById('pwToggle').addEventListener('click', function() {
    const pw = document.getElementById('password');
    const show = pw.type === 'password';
    pw.type = show ? 'text' : 'password';
    this.textContent = show ? '🙈' : '👁';
  });

  // ── Password strength ─────────────────────────────────────────────
  document.getElementById('password').addEventListener('input', function() {
    const v = this.value;
    let score = 0;
    if (v.length >= 8)  score++;
    if (v.length >= 12) score++;
    if (/[A-Z]/.test(v) && /[a-z]/.test(v)) score++;
    if (/\d/.test(v))   score++;
    if (/[^A-Za-z0-9]/.test(v)) score++;

    const fill = document.getElementById('strengthFill');
    const label = document.getElementById('strengthLabel');
    const pct = [0, 20, 40, 65, 85, 100][score];
    const colors = ['#e74c3c','#e67e22','#f1c40f','#2ecc71','#27ae60'];
    const labels = ['Too short','Weak','Fair','Good','Strong','Very strong'];

    fill.style.width = pct + '%';
    fill.style.background = colors[score-1] || '#ccc';
    label.textContent = v ? labels[score] : 'Enter a password';
  });

  // ── Contact: numeric only ─────────────────────────────────────────
  document.getElementById('contactNo').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9+\-() ]/g,'');
  });

  // ── Validation helpers ────────────────────────────────────────────
  const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  function setErr(id, errId, msg) {
    const inp = document.getElementById(id);
    const err = document.getElementById(errId);
    inp.classList.add('error');
    if (msg) err.textContent = '⚠ ' + msg;
    err.classList.add('show');
    return false;
  }
  function clearErr(id, errId) {
    document.getElementById(id).classList.remove('error');
    document.getElementById(errId).classList.remove('show');
  }

  // Live validation on blur
  const rules = [
    { id:'firstName',   errId:'firstNameErr',   check: v => v.trim() !== '',            msg:'First name is required' },
    { id:'surname',     errId:'surnameErr',     check: v => v.trim() !== '',            msg:'Surname is required' },
    { id:'customerName',errId:'customerNameErr',check: v => v.trim() !== '',            msg:'Customer name is required' },
    { id:'gender',      errId:'genderErr',      check: v => v !== '',                   msg:'Please select a gender' },
    { id:'dob',         errId:'dobErr',         check: v => v !== '',                   msg:'Date of birth is required' },
    { id:'address',     errId:'addressErr',     check: v => v.trim() !== '',            msg:'Address is required' },
    { id:'city',        errId:'cityErr',        check: v => v.trim() !== '',            msg:'City is required' },
    { id:'contactNo',   errId:'contactNoErr',   check: v => /^[0-9+\-() ]{7,15}$/.test(v.trim()), msg:'Valid contact number required (digits only)' },
    { id:'email',       errId:'emailErr',       check: v => emailRx.test(v.trim()),     msg:'Enter a valid email address (e.g. name@domain.com)' },
    { id:'password',    errId:'passwordErr',    check: v => v.length >= 8,             msg:'Password must be at least 8 characters' },
  ];

  rules.forEach(r => {
    const el = document.getElementById(r.id);
    el.addEventListener('blur', () => {
      if (!r.check(el.value)) setErr(r.id, r.errId, r.msg);
      else clearErr(r.id, r.errId);
    });
    el.addEventListener('input', () => {
      if (r.check(el.value)) clearErr(r.id, r.errId);
    });
  });

  // ── Form submit ───────────────────────────────────────────────────
  document.getElementById('regForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let valid = true;
    rules.forEach(r => {
      const el = document.getElementById(r.id);
      if (!r.check(el.value)) { setErr(r.id, r.errId, r.msg); valid = false; }
      else clearErr(r.id, r.errId);
    });
    if (!valid) {
      const firstErr = document.querySelector('.error');
      if (firstErr) firstErr.scrollIntoView({ behavior:'smooth', block:'center' });
      return;
    }
    // Success
    const toast = document.getElementById('toast');
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3500);
    // Re-generate ID after success
    setTimeout(() => {
      document.getElementById('custIdDisplay').textContent = genId();
    }, 400);
  });

  // ── Reset ─────────────────────────────────────────────────────────
  function resetForm() {
    document.getElementById('regForm').reset();
    rules.forEach(r => clearErr(r.id, r.errId));
    document.getElementById('ageValue').textContent = '—';
    document.getElementById('strengthFill').style.width = '0%';
    document.getElementById('strengthLabel').textContent = 'Enter a password';
    document.getElementById('custIdDisplay').textContent = genId();
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