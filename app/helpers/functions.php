<?php
function escapeCharacters($parameter)
{
    return htmlentities(htmlspecialchars(trim($parameter)));
}
