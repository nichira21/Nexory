<style>
body.cookie-lock {
  overflow: hidden;
  height: 100vh;
}
</style>

<!-- COOKIE MODAL -->
<div class="modal fade" id="cookieModal" tabindex="-1"
     data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 p-3">

      <div class="modal-body text-center">
        <h5 class="mb-3">Cookie Preference</h5>

        <p class="small text-muted">
          Kami menggunakan cookie, termasuk cookie pihak ketiga, untuk
          meningkatkan fungsi situs, menganalisis trafik, dan menampilkan
          konten yang relevan dengan minat Anda.
        </p>

        <p class="small text-muted">
          Anda dapat menerima semua cookie atau mengatur preferensi.
        </p>
      </div>

      <div class="modal-footer d-flex flex-column gap-2 border-0">
        <button class="btn btn-dark w-100" onclick="acceptCookies()">
          ACCEPT ALL
        </button>

        <button class="btn btn-outline-dark w-100" onclick="openSettings()">
          COOKIE SETTINGS
        </button>
      </div>

    </div>
  </div>
</div>


<!-- COOKIE SETTINGS MODAL -->
<div class="modal fade" id="cookieSettingsModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="modal-title">Cookie Settings</h5>
      </div>

      <div class="modal-body">

        <!-- ESSENTIAL -->
        <div class="border-bottom pb-3 mb-3">
          <div class="d-flex justify-content-between">
            <strong>Essential Cookies</strong>
            <span class="badge bg-secondary">Always Active</span>
          </div>
          <p class="small text-muted mt-2">
            Cookie ini diperlukan untuk memastikan fungsi dasar website berjalan
            dengan baik dan aman. Termasuk di dalamnya adalah pengelolaan sesi,
            autentikasi pengguna, keamanan formulir, serta preferensi teknis
            yang dibutuhkan agar halaman dapat ditampilkan dengan benar.
            <br><br>
            Cookie jenis ini tidak menyimpan informasi pribadi untuk tujuan
            pemasaran dan tidak dapat dinonaktifkan.
          </p>
        </div>

        <!-- ANALYTICS -->
        <div class="border-bottom pb-3 mb-3">
          <div class="d-flex justify-content-between align-items-center">
            <strong>Analytics Cookies</strong>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="analyticsCookies">
            </div>
          </div>
          <p class="small text-muted mt-2">
            Cookie analitik membantu kami memahami bagaimana pengunjung
            berinteraksi dengan website, seperti halaman yang paling sering
            dikunjungi, durasi kunjungan, sumber trafik, serta pola penggunaan
            lainnya.
            <br><br>
            Informasi yang dikumpulkan bersifat agregat dan anonim, digunakan
            semata-mata untuk meningkatkan performa, konten, dan pengalaman
            pengguna. Data ini tidak digunakan untuk mengidentifikasi individu
            secara langsung.
          </p>
        </div>

        <!-- MARKETING -->
        <div>
          <div class="d-flex justify-content-between align-items-center">
            <strong>Marketing Cookies</strong>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="marketingCookies">
            </div>
          </div>
          <p class="small text-muted mt-2">
            Cookie pemasaran digunakan untuk menampilkan konten promosi dan iklan
            yang relevan dengan minat Anda. Cookie ini memungkinkan kami dan
            mitra pihak ketiga untuk menampilkan iklan yang lebih sesuai,
            membatasi frekuensi tampilan iklan, serta mengukur efektivitas
            kampanye pemasaran.
            <br><br>
            Data yang dikumpulkan dapat dibagikan dengan mitra periklanan dan
            platform media untuk tujuan personalisasi iklan di berbagai situs
            dan perangkat.
          </p>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Cancel
        </button>
        <button class="btn btn-dark" onclick="saveCookieSettings()">
          Save Preferences
        </button>
      </div>

    </div>
  </div>
</div>







<script>
const COOKIE_DAYS = 180;

function setCookie(name, value) {
  const d = new Date();
  d.setTime(d.getTime() + (COOKIE_DAYS * 86400000));
  document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
}

function getCookie(name) {
  return document.cookie
    .split('; ')
    .find(row => row.startsWith(name + '='))?.split('=')[1];
}

/* === ACTIONS === */

function acceptCookies() {
  setCookie('cookie_consent', 'accepted');
  setCookie('cookie_analytics', '1');
  setCookie('cookie_marketing', '1');
  unlockPage();
  closeModal('cookieModal');
}

function openSettings() {
  closeModal('cookieModal');

  document.getElementById('analyticsCookies').checked =
    getCookie('cookie_analytics') === '1';

  document.getElementById('marketingCookies').checked =
    getCookie('cookie_marketing') === '1';

  new bootstrap.Modal(
    document.getElementById('cookieSettingsModal'),
    { backdrop: 'static', keyboard: false }
  ).show();
}

function saveCookieSettings() {
  setCookie('cookie_consent', 'custom');
  setCookie('cookie_analytics',
    document.getElementById('analyticsCookies').checked ? '1' : '0');
  setCookie('cookie_marketing',
    document.getElementById('marketingCookies').checked ? '1' : '0');

  unlockPage();
  closeModal('cookieSettingsModal');
}

function closeModal(id) {
  const modal = bootstrap.Modal.getInstance(
    document.getElementById(id)
  );
  if (modal) modal.hide();
}

function unlockPage() {
  document.body.classList.remove('cookie-lock');
}

/* === INIT === */
document.addEventListener('DOMContentLoaded', () => {
  if (!getCookie('cookie_consent')) {
    document.body.classList.add('cookie-lock');
    new bootstrap.Modal(
      document.getElementById('cookieModal'),
      { backdrop: 'static', keyboard: false }
    ).show();
  }
});
</script>

