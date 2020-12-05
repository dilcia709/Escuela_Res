<?php
function hashingPassword($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function verifyPasswordField($original, $hashed)
{
    return password_verify($original,$hashed);
}