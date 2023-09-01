<div class="gym_shedule_popup">
	<div class="inner" data-step="event_details">
		<div class="close"></div>

		<div class="thanks_title">Thanks for booking!</div>
		<div class="thanks_subtitle">You booking successful</div>

		<div class="time"></div>
		<div class="duration">
			Duration: <span></span>
		</div>

		<div class="title"></div>
		<div class="description"></div>
		<div class="blocks_by_2">
			<div class="item">
				<div class="label">
					Class Type / Studio:
				</div>
				<div class="text location"></div>
			</div>
			<div class="item">
				<div class="label">
					Intensity:
				</div>
				<div class="text intensity"></div>
			</div>
		</div>

		<div class="blocks_by_2">
			<div class="item">
				<div class="label">
					Instructors:
				</div>
				<div class="text instructors"></div>
			</div>
			<div class="item">
				<div class="label">
					Group Type:
				</div>
				<div class="text categories"></div>
			</div>
		</div>

		<div class="actions">
			<button type="button"
					class="next"
					data-id=""
					data-date=""
			>
				Next
			</button>
		</div>
	</div>

	<div class="inner" data-step="auth">
		<div class="close"></div>

		<div class="title">LOGIN</div>

		<form action="gym-schedule-login" id="schedule-login">
			<label>
				Member ID or Email Address:
				<input name="login" type="text" placeholder="Member ID or Email Address">
			</label>

			<label>
				Password:
				<input name="password" type="password" placeholder="Password">
			</label>


			<div class="actions blocks_by_2">
				<div class="item">
					<button type="submit">
						LOG IN
					</button>
				</div>
				<div class="item">
					<a href="/plans/">
						Forgot Password
					</a>
				</div>
			</div>

			<div class="blocks_by_2">
				<div class="item bold">
					Don’t have an account?
				</div>
				<div class="item">
					<a href="/plans/">
						Sign Up
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
