<?php
if ( !defined('ABSPATH')) exit;
class nusantara_client_compress
{
function __construct($perform)
    {
    $nusantara_css_perform = true;
    $nusantara_js_perform = false;
    $nusantara_comment_move = true;
        if (!empty($perform))
        {
            $this->nusantara_onparse($perform);
        }
    }
function __toString()
    {
        return $this->html;
    }
function nusantara_comment_moving($mentah, $thiny)
    {

        $mentah = strlen($mentah);
        $thiny = strlen($thiny);
        $nusantara_savings = ($mentah-$thiny) / $mentah * 10;
        $nusantara_savings = round($nusantara_savings, 2);
        return '';

    }
function nusantara_compresinghtml($perform)
    {
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $perform, $matches, PREG_SET_ORDER);
        $overriding = false;
        $mentah_tag = false;

        // Variable 
        $perform = '';
        foreach ($matches as $nusantara_got)
        {

            $tag = (isset($nusantara_got['tag'])) ? strtolower($nusantara_got['tag']) : null;
            $nusantara_optimized = $nusantara_got[0];
            if (is_null($tag))
            {

                if ( !empty($nusantara_got['script']) )
                {
                    $whitespaceip = $this->nusantara_js_perform;
                }
                else if ( !empty($nusantara_got['style']) )
                {
                    $css = $this->nusantara_css_perform;
                 // ;
		$css = preg_replace('/[ \t\n\r]*;[ \t\n\r]*/',';',$css);

		// :
		$css = preg_replace('/[ \t\n\r]*:[ \t\n\r]*/',':',$css);

		// ,
		$css = preg_replace('/[ \t\n\r]*,[ \t\n\r]*/',',',$css);

		// (
		$css = preg_replace('/[ \t\n\r]*\([ \t\n\r]*/','(',$css);

		// )
		$css = preg_replace('/[ \t\n\r]*\)[ \t\n\r]*/',')',$css);

		// {
		$css = preg_replace('/[ \t\n\r]*\{[ \t\n\r]*/','{',$css);

		// }
		$css = preg_replace('/[ \t\n\r]*\}[ \t\n\r]*/','}',$css);

                }
                else if ($nusantara_optimized == '')
                {
                    $overriding = !$overriding;

                    // let me go
                    continue;
                }
                else if ($this->nusantara_comment_move)
                {
                    if (!$overriding && $mentah_tag != 'textarea')
                    {
                        $nusantara_optimized = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $nusantara_optimized);
                    }
                }
            }
            else
            {
                if ($tag == 'pre' || $tag == 'textarea')
                {
                    $mentah_tag = $tag;
                }
                else if ($tag == '/pre' || $tag == '/textarea')
                {
                    $mentah_tag = false;
                }
                else
                {
                    if ($mentah_tag || $overriding)
                    {
                        $whitespaceip = false;
                    }
                    else
                    {
                        $whitespaceip = true;

                        // Remove any empty attributes, except:
                        // action, alt, content, src
                        $nusantara_optimized = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $nusantara_optimized);
                        $nusantara_optimized = str_replace(' />', '/>', $nusantara_optimized);
                    }
                }
            }
            if ($whitespaceip)
            {
                $nusantara_optimized = $this->nusantara_whitespace($nusantara_optimized);
            }
            $perform .= $nusantara_optimized;
        }
        return $perform;
    }

function nusantara_onparse($perform)
    {
        $this->html = $this->nusantara_compresinghtml($perform);   
    }
function nusantara_whitespace($whitespace)
    {
        $whitespace = str_replace("\t", ' ', $whitespace);
        $whitespace = str_replace("\n",  '', $whitespace);
        $whitespace = str_replace("\r",  '', $whitespace);        
        while (stristr($whitespace, '  '))
        {
            $whitespace = str_replace('  ', ' ', $whitespace);
        }
        return $whitespace;
    }
}
function nusantara_client_compress_done($perform)
{
    return new nusantara_client_compress($perform);
}
function nusantara_client_compress_actions()
{
    ob_start('nusantara_client_compress_done');
}

$nusantara_options = get_option('nusantara_options');    	
if (!empty($nusantara_options['nusantara_compress']) == '1'):
add_action('get_header', 'nusantara_client_compress_actions');
endif;