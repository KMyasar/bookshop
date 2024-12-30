<div class="container">
	<div class="profile-header">
		<div class="profile-img">
			<!-- <img src="./bg.jpg" width="200" alt="Profile Image"> -->
		</div>
		<div class="profile-nav-info">
			<h3 class="user-name">
				<?php
                $user = new user(sessions::get('username'));
				print(sessions::get('username'));
				?>
			</h3>
			<div class="address">
				<p id="state" class="state">
					<?php
				    if ($user->getstate() != null) {
				        print($user->getstate() . ",");
				    }
				?>
				</p>
				<span id="country" class="country">
					<?php
				if ($user->getcountry() == null) {
				    echo "location";
				} else {
				    print($user->getcountry());
				}
				?></span>
			</div>

		</div>
		<div class="profile-option">
			<div class="notification">
				<i class="fa fa-bell"></i>
				<span class="alert-message">3</span>
			</div>
		</div>
	</div>

	<div class="main-bd">
		<div class="left-side">
			<div class="profile-side">
				<p class="mobile-no"><i class="fa fa-phone"></i>
					<?php
				if ($user->getphone() != null) {
				    print($user->getphone());
				} else {
				    print("update mobile number");
				}
				?>
				</p>
				<p class="user-mail"><i class="fa fa-envelope"></i>
					<?php
				print($user->getemail());
				?>
				</p>
				<div class="user-bio">
					<p class="bio">
						<?php
				    print("Profession :     ");
				if ($user->getprofession() != null) {
				    print($user->getprofession());
				} else {
				    print("update");
				}
				?>
					</p>
				</div>
				<div class="profile-btn">
					<button class="chatbtn" id="chatBtn"><i class="fa fa-comment"></i> Chat</button>
					<button class="createbtn" id="Create-post"><i class="fa fa-plus"></i> Create</button>
				</div>
			</div>

		</div>
		<div class="right-side">

			<div class="nav">
				<ul>
					<li onclick="tabs(0)" class="user-post active">Bio</li>
					<li onclick="tabs(1)" class="user-review">history</li>
					<li onclick="tabs(2)" class="user-setting"> Settings</li>
				</ul>
			</div>
			<div class="profile-body">
				<div class="profile-posts tab">
					<h1>Bio</h1>
					<p>
						<?php
				if ($user->getbio() != null) {
				    echo $user->getbio();
				} else {
				    echo "Update bio";
				}
				?>
					</p>
				</div>
				<div class="profile-reviews tab">
					<h6>history</h6>
					<div class="row row-lg row-30">
						<?php
				for ($i = 0; $i < 13; $i++) {
				    ?>
						<div class="col-sm-6 col-lg-4 col-xl-6">
							<!-- Product-->
							<article class="product wow fadeInLeft" data-wow-delay=".15s">
								<div class="product-figure"><img src="images/product-1-161x162.png" alt="" width="161"
										height="162" />
								</div>
								<div class="product-rating"><span class="mdi mdi-star"></span><span
										class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
										class="mdi mdi-star"></span><span class="mdi mdi-star text-gray-13"></span>
								</div>
								<h6 class="product-title">Margherita Pizza</h6>
								<div class="product-price-wrap">
									<div class="product-price">$24.00</div>
								</div>
								<div class="product-button">
									<div class="button-wrap"><a class="button button-xs button-primary button-winona"
											href="#">Add to cart</a></div>
									<div class="button-wrap"><a class="button button-xs button-secondary button-winona"
											href="#">View Product</a></div>
								</div>
							</article>
						</div>
						<?php
				}
				?>
					</div>
				</div>
				<div class="profile-settings tab">
					<div class="account-setting">
						<form action="_templates/account/change.php" method="POST" autocomplete="on">
							<div class="form">
								<div class="title">Account setting</div>
								<div class="input-container ic1">
									<label for="first" class="placeholder">firstname</label>
									<input name="idfirst" id="first" class="input" value="<?php print($user->getfirstname());?>" type="text"
										placeholder=" " />
									<div class="cut cut-short"></div>
								</div>
								<div class="input-container ic2">
									<label for="last" class="placeholder">lastname</label>
									<input name="idlast" id="last" class="input"
										value="<?php print($user->getlastname()) ?>"
										type="text" placeholder=" " />
									<div class="cut"></div>
								</div>
								<div class="input-container ic2">
									<label for="phone" class="placeholder">phone</label>
									<input name="idphone" id="phone" class="input"
										value="<?php print($user->getphone()) ?>"
										type="tel" placeholder=" " required />
									<div class="cut"></div>
								</div>
								<div class="input-container ic2">
									<label for="bio" class="placeholder">Bio</label>
									<input name="idbio" id="bio" class="input"
										value="<?php print($user->getbio()) ?>"
										type="text" placeholder=" " />
									<div class="cut"></div>
								</div>
								<div class="input-container ic2">
									<label for="profession" class="placeholder">Profession</label>
									<input name="idprofession" id="profession" class="input"
										value="<?php print($user->getprofession()) ?>"
										type="text" placeholder=" " />
									<div class="cut"></div>
								</div>
								<div class="input-container ic2">
									<label for="dob" class="placeholder">DOB</label>
									<input name="iddob" id="dob" class="input"
										value="<?php print($user->getdob()) ?>"
										type="date" placeholder=" " required />
									<div class="cut"></div>
								</div>
								<div class="input-container ic2">
									<label for="city" class="placeholder">city</label>
									<input name="idcity" id="city" class="input"
										value="<?php print($user->getstate()) ?>"
										type="text" placeholder=" " />
									<div class="cut"></div>
								</div>
								<div class="input-container ic2">
									<label for="country" class="placeholder">country</label>
									<input name="idcountry" id="country" class="input"
										value="<?php print($user->getcountry()) ?>"
										type="text" placeholder=" " />
									<div class="cut"></div>
								</div>
								<input type="hidden" name="uid"
									value="<?php print($user->id) ?>">
								<button type="submit" class="submit">submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>