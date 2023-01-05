<form method="post">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['userId']; ?>" />
    <ul>
        <li>
            <label for="activity">Activity Type</label>
            <select id="activity" name="activity" required>
                <option value="0">Cycling</option>
                <option value="1">Football</option>
                <option value="2">Walking</option>
            </select>
        <li>
            <label for="distance">Distance</label>
            <input type="number" id="distance" name="distance" step="0.1" required />
        </li>
        <li>
            <label for="time">Duration</label>
            <input type="time" id="time" name="time" value="00:00" required />
            <span class="help">hours:minutes:seconds</span>
        </li>
        <li>
            <label for="activity_date">Date of activity</label>
            <input type="date" id="activity_date" name="activity_date" value="<?php echo date('Y-m-d'); ?>" required />
        </li>
        <li>
            <input type="submit" />
        </li>
    </ul>
</form>
