<?php


namespace App\Routines\EloquentModelsGeneration;


class StringUtils
{
    public static function snakeCaseToCamelCase(string $string)
    {
        $camelCaseAttrName = ucfirst(strtolower($string));
        $underscorePositions = [];
        $len = strlen($camelCaseAttrName);
        for ($i = 0; $i < $len; $i++) {
            if ($camelCaseAttrName[$i] === '_') {
                $underscorePositions[] = $i;
            }
        }
        foreach ($underscorePositions as $underscorePos) {
            $camelCaseAttrName[$underscorePos + 1] = strtoupper($camelCaseAttrName[$underscorePos + 1]);
        }
        $camelCaseAttrName = str_replace('_', '', $camelCaseAttrName);
        return $camelCaseAttrName;
    }
    public static function pluralizeWord($word)
    {
        $plural = array(
            '/(quiz)$/i' => '1zes',
            '/^(ox)$/i' => '1en',
            '/([m|l])ouse$/i' => '1ice',
            '/(matr|vert|ind)ix|ex$/i' => '1ices',
            '/(x|ch|ss|sh)$/i' => '1es',
            '/([^aeiouy]|qu)ies$/i' => '1y',
            '/([^aeiouy]|qu)y$/i' => '1ies',
            '/(hive)$/i' => '1s',
            '/(?:([^f])fe|([lr])f)$/i' => '12ves',
            '/sis$/i' => 'ses',
            '/([ti])um$/i' => '1a',
            '/(buffal|tomat)o$/i' => '1oes',
            '/(bu)s$/i' => '1ses',
            '/(alias|status)/i'=> '1es',
            '/(octop|vir)us$/i'=> '1i',
            '/(ax|test)is$/i'=> '1es',
            '/s$/i'=> 's',
            '/$/'=> 's');

        $uncountable = array('equipment', 'information', 'rice', 'money', 'species', 'series', 'fish', 'sheep');

        $irregular = array(
            'person' => 'people',
            'man' => 'men',
            'child' => 'children',
            'sex' => 'sexes',
            'move' => 'moves');

        $lowercased_word = strtolower($word);

        foreach ($uncountable as $_uncountable){
            if(substr($lowercased_word,(-1*strlen($_uncountable))) == $_uncountable){
                return  $word;
            }
        }

        foreach ($irregular as $_plural=> $_singular){
            if (preg_match('/('.$_plural.')$/i', $word, $arr)) {
                return preg_replace('/('.$_plural.')$/i', substr($arr[0],0,1).substr($_singular,1), $word);
            }
        }

        foreach ($plural as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }
        return false;
    }

}
