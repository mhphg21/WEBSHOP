<?php
class CsrfHelper
{
    /**
     * Tạo CSRF token mới
     */
    public static function generateToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Lấy CSRF token hiện tại
     */
    public static function getToken()
    {
        return self::generateToken();
    }

    /**
     * Verify CSRF token
     */
    public static function verify($token = null)
    {
        if ($token === null) {
            $token = $_POST['csrf_token'] ?? '';
        }

        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Verify CSRF token hoặc throw exception
     */
    public static function verifyOrFail($token = null)
    {
        if (!self::verify($token)) {
            throw new Exception('CSRF token validation failed. Please refresh the page and try again.');
        }
        return true;
    }

    /**
     * Regenerate CSRF token
     */
    public static function regenerateToken()
    {
        unset($_SESSION['csrf_token']);
        return self::generateToken();
    }

    /**
     * Tạo hidden input field cho form
     */
    public static function field()
    {
        $token = self::getToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
    }
}
