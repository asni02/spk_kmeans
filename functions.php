<?php
error_reporting(~E_NOTICE);
session_start();
include 'config.php';
include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'composer/vendor/autoload.php';

function _post($key, $val = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];
    else
        return $val;
}

function _get($key, $val = null)
{
    global $_GET;
    if (isset($_GET[$key]))
        return $_GET[$key];
    else
        return $val;
}

function _session($key, $val = null)
{
    global $_SESSION;
    if (isset($_SESSION[$key]))
        return $_SESSION[$key];
    else
        return $val;
}

$mod = _get('m');
$act = _get('act');

$rows = $db->get_results("SELECT * FROM tb_alternatif ORDER BY kode_alternatif");
foreach ($rows as $row) {
    $ALTERNATIF[$row->kode_alternatif] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
foreach ($rows as $row) {
    $KRITERIA[$row->kode_kriteria] = $row;
}
function get_acak_option($selected = 0)
{
    $arr = array(
        0 => 'k Pertama',
        1 => 'Acak',
        2 => 'Manual',
    );
    $a = '';
    foreach ($arr as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val</option>";
        else
            $a .= "<option value='$key'>$val</option>";
    }
    return $a;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr((string)$var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}
function get_komposisi()
{
    global $ALTERNATIF;
    $arr = array();
    $keys = array_keys($ALTERNATIF);

    foreach ($keys as $key) {
        foreach ($keys as $k) {
            if ($key != $k)
                $arr[$key][$k] = 1;
        }
    }

    $result = array();
    foreach ($arr as $key => $val) {
        foreach ($val as $k => $v) {
            $result[] = array($key, $k);
        }
    }

    return $result;
}

function get_normal($data = array(), $komposisi = array())
{
    $arr = array();

    global $KRITERIA;

    foreach ($KRITERIA as $key => $val) {
        foreach ($komposisi as $k => $v) {
            $arr[$key][] = array($v[0], $v[1]);
        }
    }
    return $arr;
}

function get_selisih($data = array(), $normal = array())
{
    $arr = array();

    foreach ($normal as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = $data[$v[0]][$key] - $data[$v[1]][$key];
        }
    }
    return $arr;
}

function get_data()
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rel_alternatif ORDER BY kode_alternatif, kode_kriteria");
    $data = array();
    foreach ($rows as $row) {
        $data[$row->kode_alternatif][$row->kode_kriteria] = $row->nilai;
    }
    return $data;
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function esc_field($str)
{
    if ($str)
        return addslashes($str);
}

function parse_file_name($file_name)
{
    $x = strtolower($file_name);
    $x = str_replace(array(' '), '-', $x);
    return $x;
}

function get_words($str, $numb = 10, $suffix = '...')
{
    $str = strip_tags($str);
    $arr_str = explode(' ', $str, $numb + 1);
    if (count($arr_str) <= $numb) {
        return $str;
    } else {
        array_pop($arr_str);
        return implode(' ', $arr_str) . $suffix;
    }
}

function get_option($option_name)
{
    global $db;
    return $db->get_var("SELECT option_value FROM tb_options WHERE option_name='$option_name'");
}

function update_option($option_name, $option_value)
{
    global $db;
    return $db->query("UPDATE tb_options SET option_value='$option_value' WHERE option_name='$option_name'");
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function alert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function tgl_indo($date)
{
    $tanggal = explode('-', $date);

    $array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $bulan = $array_bulan[$tanggal[1] * 1];

    return $tanggal[2] . ' ' . $bulan . ' ' . $tanggal[0];
}

function dd($arr)
{
    echo '<pre>' . print_r($arr, 1) . '</pre>';
}
