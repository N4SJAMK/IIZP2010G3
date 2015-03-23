<!-- Dialogs -->
<div id="dialog-deleteAdmin" title="Confirm admin removal">
	<p>Only the admin right will be removed. User account will remain.</p>
	<form>
		<input type="hidden" name="adminid" value="">
	</form>
</div>

<div id="dialog-addAdmin" title="Add new admin">
	<form>
		<input type="text" name="email" placeholder="Email">
	</form>
</div>

<div id="dialog-promoteToAdmin" title="Promote to admin">
	<p>Are you sure you want to promote this user to admin?</p>
	<form>
		<input type="hidden" name="userid" value="">
	</form>
</div>

<div id="dialog-backUpNow" title="Confirm back-up operation">
	<p>This will back-up the database into the defined folder.</p>
</div>

<div id="dialog-msg" title="Message from the server">
	<p></p>
</div>

<div id="dialog-changePassword" title="Change user's password">
	<p>Please, type the new password for this user.</p>
	<form>
		<input type="hidden" name="userid" value="">
		<input type="password" name="newpassword" placeholder="New password">
	</form>
</div>

<div id="dialog-deleteBoard" title="Confirm board removal">
	<p>Are you sure you want to completely remove this board and its tickets?</p>
	<form>
		<input type="hidden" name="boardid" value="">
	</form>
</div>

<div id="dialog-deleteUser" title="Confirm user removal">
	<p>Are you sure you want to remove this user? All content by this user is also removed!</p>
	<form>
		<input type="hidden" name="userid" value="">
	</form>
</div>

<div id="dialog-emptyBoard" title="Confirm board emptying">
	<p>Are you sure you want to remove all tickets in this board?</p>
	<form>
		<input type="hidden" name="boardid" value="">
	</form>
</div>