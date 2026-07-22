</main>

<!-- Improved Footer -->
<footer style="border-top: 1px solid var(--border); background: var(--bg-card);">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-cubes" style="color: var(--primary); font-size: 1.5rem;"></i>
                    <span class="fw-bold fs-5">Chege JIRA</span>
                    <span class="badge bg-dark text-muted" style="font-size: 0.6rem; font-family: 'JetBrains Mono', monospace;">v1</span>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.7; max-width: 320px;">
                    Self-hosted project management platform. Track projects, log time, manage tasks with Kanban boards, and analyze your productivity — all on your own infrastructure.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" style="color: var(--text-muted); font-size: 1.1rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''"><i class="fab fa-github"></i></a>
                    <a href="#" style="color: var(--text-muted); font-size: 1.1rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: var(--text-muted); font-size: 1.1rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''"><i class="fab fa-docker"></i></a>
                </div>
            </div>

            <div class="col-6 col-lg-2">
                <h6 style="font-weight: 600; margin-bottom: 1rem; font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted);">Product</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="/features" style="color: var(--text); text-decoration: none; font-size: 0.85rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">Features</a>
                    <a href="/setup" style="color: var(--text); text-decoration: none; font-size: 0.85rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">Setup Guide</a>
                    <a href="/faqs" style="color: var(--text); text-decoration: none; font-size: 0.85rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">FAQs</a>
                    <a href="<?= site_url('auth/register') ?>" style="color: var(--text); text-decoration: none; font-size: 0.85rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">Get Started</a>
                </div>
            </div>

            <div class="col-6 col-lg-2">
                <h6 style="font-weight: 600; margin-bottom: 1rem; font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted);">Account</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="<?= site_url('auth/login') ?>" style="color: var(--text); text-decoration: none; font-size: 0.85rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">Sign In</a>
                    <a href="<?= site_url('auth/register') ?>" style="color: var(--text); text-decoration: none; font-size: 0.85rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">Register</a>
                    <a href="<?= site_url('auth/forgot-password') ?>" style="color: var(--text); text-decoration: none; font-size: 0.85rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color=''">Reset Password</a>
                </div>
            </div>

            <div class="col-lg-4">
                <h6 style="font-weight: 600; margin-bottom: 1rem; font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted);">Stack</h6>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span class="badge" style="background: rgba(239,68,68,0.1); color: var(--primary); border: 1px solid rgba(239,68,68,0.2); font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; padding: 0.35rem 0.6rem;">PHP 8.3</span>
                    <span class="badge" style="background: rgba(239,68,68,0.1); color: var(--primary); border: 1px solid rgba(239,68,68,0.2); font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; padding: 0.35rem 0.6rem;">CodeIgniter 4</span>
                    <span class="badge" style="background: rgba(239,68,68,0.1); color: var(--primary); border: 1px solid rgba(239,68,68,0.2); font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; padding: 0.35rem 0.6rem;">MySQL 8.4</span>
                    <span class="badge" style="background: rgba(239,68,68,0.1); color: var(--primary); border: 1px solid rgba(239,68,68,0.2); font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; padding: 0.35rem 0.6rem;">Docker</span>
                    <span class="badge" style="background: rgba(239,68,68,0.1); color: var(--primary); border: 1px solid rgba(239,68,68,0.2); font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; padding: 0.35rem 0.6rem;">Bootstrap 5</span>
                    <span class="badge" style="background: rgba(239,68,68,0.1); color: var(--primary); border: 1px solid rgba(239,68,68,0.2); font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; padding: 0.35rem 0.6rem;">jQuery</span>
                </div>
                <p class="mt-3" style="color: var(--text-muted); font-size: 0.8rem; line-height: 1.5;">
                    <i class="fas fa-shield-alt me-1" style="color: var(--success);"></i>
                    Powered by CodeIgniter Shield authentication.
                    <br>
                    <i class="fas fa-balance-scale me-1" style="color: var(--warning);"></i>
                    Open source under the MIT License.
                </p>
            </div>
        </div>

        <div style="border-top: 1px solid var(--border); margin-top: 2.5rem; padding-top: 1.5rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
            <div style="color: var(--text-muted); font-size: 0.8rem;">
                &copy; <?= date('Y') ?> Chege JIRA. All rights reserved.
            </div>
            <div style="display: flex; gap: 1.5rem; font-size: 0.8rem;">
                <a href="/" style="color: var(--text-muted); text-decoration: none;">Home</a>
                <a href="/features" style="color: var(--text-muted); text-decoration: none;">Features</a>
                <a href="/setup" style="color: var(--text-muted); text-decoration: none;">Setup</a>
                <a href="/faqs" style="color: var(--text-muted); text-decoration: none;">FAQs</a>
            </div>
            <div style="color: var(--text-muted); font-size: 0.75rem; font-family: 'JetBrains Mono', monospace;">
                v1.0.0
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    function toggleFaq(el) {
        el.classList.toggle('open');
        const answer = el.nextElementSibling;
        answer.classList.toggle('open');
    }
    $(document).ready(function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) $('html').attr('data-bs-theme', savedTheme);
    });
</script>
</body>
</html>
