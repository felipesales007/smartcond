<?php

namespace App\Utils;

class Validator
{
    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaSpace($attribute, $value)
    {
        return preg_match('/^[A-zÀ-ú ]+$/i', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaDigit($attribute, $value)
    {
        return preg_match('/^[A-zÀ-ú\-.,\/ ]+$/i', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaDigitNumber($attribute, $value)
    {
        return preg_match('/^[A-zÀ-ú0-9\-.\/, ]+$/i', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaGroup($attribute, $value)
    {
        return preg_match('/^[a-z_-]+$/', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaUrl($attribute, $value)
    {
        return preg_match('/^[_\-{}?\/a-z]+$/', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaRoute($attribute, $value)
    {
        return preg_match('/^[a-z._\-]+$/', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaController($attribute, $value)
    {
        return preg_match('/^[A-z@\\_]+$/i', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function alphaIcon($attribute, $value)
    {
        return preg_match('/^[a-z\- ]+$/', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function formatCpf($attribute, $value)
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function formatCnpj($attribute, $value)
    {
        return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) > 0;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function formatCpfCnpj($attribute, $value)
    {
        return $this->formatCpf($attribute, $value) || $this->formatCnpj($attribute, $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function formatNis($attribute, $value)
    {
        return preg_match('/^\d{3}\.\d{5}\.\d{2}-\d{1}$/', $value) > 0;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function formatCep($attribute, $value)
    {
        return preg_match('/^[0-9]{5}\-[0-9]{3}$/', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function formatController($attribute, $value)
    {
        return preg_match('/^[A-z\\_]+@[A-z\\_]+$/i', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function phones($attribute, $value)
    {
        return preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function cpf($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function cnpj($attribute, $value)
    {
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function cpfCnpj($attribute, $value)
    {
        return ($this->cpf($attribute, $value) || $this->cnpj($attribute, $value));
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function cnh($attribute, $value)
    {
        $ret = false;

        if ((strlen($input = preg_replace('/[^\d]/', '', $value)) == 11) && (str_repeat($input[1], 11) != $input)) {
            $dsc = 0;

            for ($i = 0, $j = 9, $v = 0; $i < 9; ++$i, --$j) {
                $v += (int) $input[$i] * $j;
            }

            if (($vl1 = $v % 11) >= 10) {
                $vl1 = 0;
                $dsc = 2;
            }

            for ($i = 0, $j = 1, $v = 0; $i < 9; ++$i, ++$j) {
                $v += (int) $input[$i] * $j;
            }

            $vl2 = ($x = ($v % 11)) >= 10 ? 0 : $x - $dsc;
            $ret = sprintf('%d%d', $vl1, $vl2) == substr($input, -2);
        }

        return $ret;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function voterTitle($attribute, $value)
    {
        $input = preg_replace('/[^\d]/', '', $value);
        $uf    = substr($input, -4, 2);

        if (((strlen($input) < 5) || (strlen($input) > 13)) || (str_repeat($input[1], strlen($input)) == $input) || ($uf < 1 || $uf > 28)) {
            return false;
        }

        $dv        = substr($input, -2);
        $base      = 2;
        $sequencia = substr($input, 0, -4);

        for ($i = 0; $i < 2; $i++) {
            $fator = 9;
            $soma  = 0;

            for ($j = (strlen($sequencia) - 1); $j > -1; $j--) {
                $soma += $sequencia[$j] * $fator;

                if ($fator == $base) {
                    $fator = 10;
                }

                $fator--;
            }

            $digito = $soma % 11;

            if (($digito == 0) and ($uf < 3)) {
                $digito = 1;
            } elseif ($digito == 10) {
                $digito = 0;
            }

            if ($dv[$i] != $digito) {
                return false;
            }

            switch ($i) {
                case '0':
                    $sequencia = $uf . $digito;
                    break;
            }
        }

        return true;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function nis($attribute, $value)
    {
        $nis = sprintf('%011s', preg_replace('{\D}', '', $value));

        if (strlen($nis) != 11 || preg_match("/^{$nis[0]}{11}$/", $nis)) {
            return false;
        }

        for ($d = 0, $p = 2, $c = 9; $c >= 0; $c--, ($p < 9) ? $p++ : $p = 2) {
            $d += $nis[$c] * $p;
        }

        return ($nis[10] == (((10 * $d) % 11) % 10));
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public function decimal($attribute, $value)
    {
        return preg_match("/^((?:\d\.\d{3}\.|\d{1,3}\.)?\d{1,3},\d{2,2})$/", $value);
    }
}
