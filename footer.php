<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <h2><?php bloginfo('name'); ?></h2>
                <p><?php _e('Your trusted source for football betting tips and predictions.', 'bettingtips'); ?></p>
            </div>

            <div class="footer-links">
                <h3><?php _e('Quick Links', 'bettingtips'); ?></h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url()); ?>"><?php _e('Home', 'bettingtips'); ?></a></li>
                    <li><a href="#"><?php _e("Today's Tips", 'bettingtips'); ?></a></li>
                    <li><a href="#"><?php _e("Upcoming Matches", 'bettingtips'); ?></a></li>
                    <li><a href="#"><?php _e('Results', 'bettingtips'); ?></a></li>
                    <li><a href="#"><?php _e('About Us', 'bettingtips'); ?></a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h3><?php _e('Contact Us', 'bettingtips'); ?></h3>
                <p>
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:info@bettipspro.com">info@bettipspro.com</a>
                </p>
                <p>
                    <i class="fas fa-phone" aria-hidden="true"></i>
                    <a href="tel:+15551234567">+1 (555) 123-4567</a>
                </p>
                <div class="social-icons" aria-label="<?php esc_attr_e('Social Media Links', 'bettingtips'); ?>">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Telegram"><i class="fab fa-telegram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-disclaimer">
            <p><?php _e('Disclaimer: This website is for informational purposes only. We do not encourage gambling. Please gamble responsibly and in accordance with applicable laws in your jurisdiction.', 'bettingtips'); ?></p>
        </div>

        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'bettingtips'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
