		</div>

		<!-- Footer -->
		<footer id="footer">
			<div class="in">
				<section class="footer-widgets-container cf">
					<section class="footer-widgets cf <?php echo ( is_active_sidebar( 'footer-sidebar' ) ) ? 'widgets' : 'no-widgets'; ?>">
						<?php sds_footer_sidebar(); // Footer (3 columns) ?>
					</section>
				</section>

				<section class="copyright-area <?php echo ( is_active_sidebar( 'copyright-area-sidebar' ) ) ? 'widgets' : 'no-widgets'; ?>">
					<?php sds_copyright_area_sidebar(); ?>
				</section>

				<p class="copyright">
					<?php sds_copyright( 'Modern Business' ); ?>
				</p>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>

</html>