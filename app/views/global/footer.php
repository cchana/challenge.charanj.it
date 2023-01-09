
    </article>

</main>

<footer>

    <p>
        &#169; <?php echo date('Y'); ?> <a href="https://charanj.it" target="_blank">Charanjit Chana</a></p>

</footer>

<script>
// generic prompt when an possibly unreversable action is about to take place
function confirmAction() {
    return confirm('Are you sure? This probably can\'t be undone!');
}

// for the PWA, a native refresh button
function refresh() {
    location.reload();
    return false;
}
</script>

</body>
</html>
