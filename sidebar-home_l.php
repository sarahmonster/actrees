				

					<?php if ( is_active_sidebar( 'home_l' ) ) : ?>

						<?php dynamic_sidebar( 'home_l' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="help">
						
							<p>Please activate some Widgets.</p>
						
						</div>

					<?php endif; ?>

