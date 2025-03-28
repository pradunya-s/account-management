<?php
namespace App\Helpers;

class LuhnHelper
{
    public static function generateAccountNumber()
    {
        do {
            // Generate 11 random digits
            $baseNumber = str_pad(mt_rand(0, 99999999999), 11, '0', STR_PAD_LEFT);
            
            // Calculate Luhn check digit
            $checkDigit = self::calculateLuhnCheckDigit($baseNumber);
            
            // Final account number (11 digits + 1 check digit = 12 digits)
            $accountNumber = $baseNumber . $checkDigit;
        } while (\App\Models\Account::where('account_number', $accountNumber)->exists()); // Ensure uniqueness

        return $accountNumber;
    }

    public static function calculateLuhnCheckDigit($number)
    {
        $digits = array_map('intval', str_split($number));
        $sum = 0;
        $alt = true;

        for ($i = count($digits) - 1; $i >= 0; $i--) {
            if ($alt) {
                $digits[$i] *= 2;
                if ($digits[$i] > 9) {
                    $digits[$i] -= 9;
                }
            }
            $sum += $digits[$i];
            $alt = !$alt;
        }

        return (10 - ($sum % 10)) % 10; // Luhn checksum digit
    }
}
