<form method="post"  oninput="populateTime()">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['userId']; ?>" />
    <input type="hidden" name="time" id="time" value="00:00:00" />
    <ul>
        <li>
            <label for="activity">Activity Type</label>
            <select id="activity" name="activity" required>
                <option value="0">Cycling</option>
                <option value="1">Football</option>
                <option value="2">Walking</option>
            </select>
        </li>
        <li>
            <label for="difficulty">Difficulty</label>
            <input type="number" id="difficulty" name="difficulty" />
            <span>What setting did you use?</span>
        </li>
        <li>
            <label for="distance">Distance (km)</label>
            <input type="number" id="distance" name="distance" step="0.1" required />
        </li>
        <li>
            <label for="minutes">Duration</label>
            <div>
                <label for="hours">H:</label>
                <input type="number" id="hours" value="0" />
                <label for="minutes">M:</label>
                <input type="number" id="minutes" value="0" max="60" />
                <label for="seconds">S:</label>
                <input type="number" id="seconds" value="0" max="60" />
            </div>
            <output name="time" for="hours minutes seconds"></output>
            <!--<input type="time" id="time" name="time" value="00:00" required />
            <span class="help">minutes:seconds</span>-->
        </li>
        <li>
            <label for="activity_date">Date of activity</label>
            <input type="date" id="activity_date" name="activity_date" value="<?php echo date('Y-m-d'); ?>" required />
        </li>
        <li>
            <input type="submit" class="btn" />
        </li>
    </ul>
</form>

<script>
function populateTime() {
    let h = padNumber(hours.value),
        m = padNumber(minutes.value),
        s = padNumber(seconds.value),
        timeVal = h + ':' + m + ':' + s;
    time.value = timeVal;
}

function padNumber(number) {
    if(number < 10 || number.length == 1) {
        return '' + 0 + number;
    }
    return number;
}
</script>
