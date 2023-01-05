<form method="post" action="/">
    <ul>
        <li>
            <label for="username">Name</label>
            <select id="username" name="username" required>
                <option value="">Please Choose</option>
                <?php foreach($users as $user) {
                    echo '<option value="'.$user['handle'].'">'.$user['name'].'</option>';
                } ?>
            </select>
        </li>
        <li>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" />
        </li>
        <li>
            <input type="submit" />
        </li>
    </ul>
</form>
