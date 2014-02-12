<?php
// vim: foldmethod=marker
/**
 *  Generator.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id: 16797ead37a9a587cc6fad05259390e4e8f55c89 $
 */

// {{{ Ethna_Generator
/**
 *  スケルトン生成クラス
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_Generator
{
    /**
     *  スケルトンを生成する
     *
     *  @access public
     *  @param  string  $type       生成する対象
     *  @param  string  $app_dir    アプリケーションのディレクトリ
     *                              (nullのときはアプリケーションを特定しない)
     *  @param  mixed   residue     プラグインのgenerate()にそのまま渡す
     *  @static
     */
    public static function generate()
    {
        $arg_list   = func_get_args();
        $type       = array_shift($arg_list);
        $app_dir    = array_shift($arg_list);

        if ($app_dir === null) {
            $ctl = Ethna_Handle::getEthnaController();
        } else {
            $ctl = Ethna_Handle::getAppController($app_dir);
        }

        $plugin_manager = $ctl->getPlugin();

        $generator = $plugin_manager->getPlugin('Generator', $type);

        // 引数はプラグイン依存とする
        $ret = call_user_func_array(array($generator, 'generate'), $arg_list);
        return $ret;
    }

    /**
     *  スケルトンを削除する
     *
     *  @access public
     *  @param  string  $type       生成する対象
     *  @param  string  $app_dir    アプリケーションのディレクトリ
     *                              (nullのときはアプリケーションを特定しない)
     *  @param  mixed   residue     プラグインのremove()にそのまま渡す
     *  @static
     */
    public static function remove()
    {
        $arg_list   = func_get_args();
        $type       = array_shift($arg_list);
        $app_dir    = array_shift($arg_list);

        if ($app_dir === null) {
            $ctl = Ethna_Handle::getEthnaController();
        } else {
            $ctl = Ethna_Handle::getAppController($app_dir);
        }

        $plugin_manager = $ctl->getPlugin();
        $generator = $plugin_manager->getPlugin('Generator', $type);

        // 引数はプラグイン依存とする
        $ret = call_user_func_array(array($generator, 'remove'), $arg_list);
        return $ret;
    }
}
// }}}
