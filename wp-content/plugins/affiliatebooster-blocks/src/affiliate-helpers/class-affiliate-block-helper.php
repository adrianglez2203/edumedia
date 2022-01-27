<?php

/**
 * AFFILIATE Block Helper.
 *
 * @package AFFILIATE
 */
if (!class_exists('AFFILIATE_Block_Helper')) {

  /**
   * Class AFFILIATE_Block_Helper.
   */
  class AFFILIATE_Block_Helper
  {

    /**
     * Get affiliate-booster CSS
     *
     * @since 1.4.0
     * @param array  $attr The block attributes.
     * @param string $id The selector ID.
     * @return array The Widget List.
     */
    public static function get_propcons_css($attr, $id)
    {    // @codingStandardsIgnoreStart
      $defaults = AFFILIATE_Helper::$block_list['affiliate-booster/propsandcons']['attributes'];

      $attr = array_merge($defaults, (array) $attr);

      $selectors = self::get_propcons_selectors($attr);

      $m_selectors = self::get_propcons_mobiletselectors($attr);

      $t_selectors = self::get_propcons_tabletselectors($attr);
      // // @codingStandardsIgnoreEnd

      $desktop = AFFILIATE_Helper::generate_css($selectors, '#affiliate-style-' . $id);

      $tablet = AFFILIATE_Helper::generate_css($t_selectors, '#affiliate-style-' . $id);

      $mobile = AFFILIATE_Helper::generate_css($m_selectors, '#affiliate-style-' . $id);

      $generated_css = array(
        'desktop' => $desktop,
        'tablet'  => $tablet,
        'mobile'  => $mobile,
      );

      return $generated_css;
    }

    public static function get_propcons_selectors($attr){
      $boxshadow = array();
      if (!empty($attr['boxShadow']['openShadow']) && $attr['boxShadow']['openShadow'] == 1) {
        if ($attr['boxShadow']['inset'] === 0) {
          $inset = '';
        } else {
          $inset = $attr['boxShadow']['inset'];
        }
        $boxshadow = array(AFFILIATE_Helper::get_css_value($inset) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['horizontal'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['vertical'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['blur'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['spread'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['color']));
      }

      $desktop_css = array(
        " .affiliate-procon-inner" => array(
          "box-shadow" => implode('',$boxshadow),
        ),
        " .affiliate-propcon-title" => array(
          'font-family' => AFFILIATE_Helper::get_css_value($attr['titlefontFamily']),
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeDesktop'], $attr['titlefontSizeType']),
          'font-weight' => AFFILIATE_Helper::get_css_value($attr['titlefontWeight']),
          'font-style' => AFFILIATE_Helper::get_css_value($attr['titlefontStyle']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeight']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacing'], $attr['titleletterSpacingType']),
          'text-decoration' => AFFILIATE_Helper::get_css_value($attr['titletextDecoration']),
          'text-transform' => AFFILIATE_Helper::get_css_value($attr['titletextTransform']),
        ),
        " .affiliate-list" => array(
          'font-family' => AFFILIATE_Helper::get_css_value($attr['listfontFamily']),
          'font-size' => AFFILIATE_Helper::get_css_value($attr['listfontSizeDesktop'], $attr['listfontSizeType']),
          'font-weight' => AFFILIATE_Helper::get_css_value($attr['listfontWeight']),
          'font-style' => AFFILIATE_Helper::get_css_value($attr['listfontStyle']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['listlineHeight']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['listletterSpacing'], $attr['listletterSpacingType']),
          'text-decoration' => AFFILIATE_Helper::get_css_value($attr['listtextDecoration']),
          'text-transform' => AFFILIATE_Helper::get_css_value($attr['listtextTransform']),
        ),
        " .affiliate-props-title" => array(
          'background' => AFFILIATE_Helper::get_css_value($attr['propsBgColor']),
          'color' => AFFILIATE_Helper::get_css_value($attr['propsTextColor']),
        ),
        " .affiliate-const-title" => array(
          'background' => AFFILIATE_Helper::get_css_value($attr['consBgColor']),
          'color' => AFFILIATE_Helper::get_css_value($attr['consTextColor']),
        ),
        " .affiliate-props-list li:before" => array(
          'color' => AFFILIATE_Helper::get_css_value($attr['propsIconColor']),
        ),
        " .affiliate-cons-list li:before" => array(
          'color' => AFFILIATE_Helper::get_css_value($attr['consIconColor']),
        ),
        " .affiliate-props-list li" => array(
          'color' => AFFILIATE_Helper::get_css_value($attr['propsListColor']),
        ),
        " .affiliate-cons-list li" => array(
          'color' => AFFILIATE_Helper::get_css_value($attr['consListColor']),
        ),
      );

      $desktop_css =  AFFILIATE_Helper::regenerate_stylesheet($desktop_css);

      return $desktop_css;
    }

    public static function get_propcons_tabletselectors($attr){
      $tablet_css = array(
        " .affiliate-propcon-title" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeTablet'], $attr['titlefontSizeTypeTablet']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightTablet']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingTablet'], $attr['titleletterSpacingTypeTablet']),
        ),
        " .affiliate-list" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['listfontSizeTablet'], $attr['listfontSizeTypeTablet']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['listlineHeightTablet']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['listletterSpacingTablet'], $attr['listletterSpacingTypeTablet']),
        ),
      );

      $tablet_css =  AFFILIATE_Helper::regenerate_stylesheet($tablet_css);

      return $tablet_css;
    }

    public static function get_propcons_mobiletselectors($attr){
      $mobile_css = array(
        " .affiliate-propcon-title" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeMobile'], $attr['titlefontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingMobile'], $attr['titleletterSpacingTypeMobile']),
        ),
        " .affiliate-list" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['listfontSizeMobile'], $attr['listfontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['listlineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['listletterSpacingMobile'], $attr['listletterSpacingTypeMobile']),
        ),
      );

      $mobile_css =  AFFILIATE_Helper::regenerate_stylesheet($mobile_css);

      return $mobile_css;
    }

    public static function get_abnotification_css( $attr, $id ) {       // @codingStandardsIgnoreStart

      $defaults = AFFILIATE_Helper::$block_list['affiliate-booster/ab-notification-box']['attributes'];

      $attr = array_merge( $defaults, $attr );

      $m_selectors = array();
      $t_selectors = array();
      
      $boxshadow = array();
      if ($attr['boxShadow']['openShadow'] == 1) {
        if ($attr['boxShadow']['inset'] === 0) {
          $inset = '';
        } else {
          $inset = $attr['boxShadow']['inset'];
        }
        $boxshadow = array(AFFILIATE_Helper::get_css_value($inset) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['horizontal'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['vertical'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['blur'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['spread'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['color']));
      }

      $selectors = array(
        " .affiliate-notification-inner" => array(
          'width' => AFFILIATE_Helper::get_css_value($attr['customWidth'], $attr['customWidthType']),
          'box-shadow'=> implode('',$boxshadow),
        ),  
        " .affiliate-notification-content" => array(
          'font-family' => AFFILIATE_Helper::get_css_value($attr['cntnfontFamily']),
          'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeDesktop'], $attr['cntnfontSizeType']),
          'font-weight' => AFFILIATE_Helper::get_css_value($attr['cntnfontWeight']),
          'font-style' => AFFILIATE_Helper::get_css_value($attr['cntnfontStyle']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeight']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacing'], $attr['cntnletterSpacingType']),
          'text-decoration' => AFFILIATE_Helper::get_css_value($attr['cntntextDecoration']),
          'text-transform' => AFFILIATE_Helper::get_css_value($attr['cntntextTransform']),
          "color" => AFFILIATE_Helper::get_css_value($attr['cntnTextColor']),
          "background" => AFFILIATE_Helper::get_css_value($attr['cntnBgColor']),
          "border-color" => AFFILIATE_Helper::get_css_value($attr['cntnBorderColor']),
          "border-style" => AFFILIATE_Helper::get_css_value($attr['cntnBorderType']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['cntnBorder']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorder']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorder']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorder']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['cntnAlignment']),
          'padding' => AFFILIATE_Helper::get_css_value($attr['cntnPadding']['top'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPadding']['right'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPadding']['left'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['cntnMargin']['top'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMargin']['right'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMargin']['left'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])),
        ),
      );

      
      $m_selectors = array(
        " .affiliate-notification-inner" => array(
          'width' => AFFILIATE_Helper::get_css_value($attr['customWidthMobile'], $attr['customWidthTypeTablet']),
        ),
        " .affiliate-notification-content" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeMobile'], $attr['cntnfontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingMobile'], $attr['cntnletterSpacingTypeMobile']),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['cntnAlignmentMobile']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorderMobile']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusMobile']['unit'])),
          'padding' => AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['top'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['right'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['left'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingMobile']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['top'], AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['right'], AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['left'], AFFILIATE_Helper::get_css_value($attr['cntnMarginMobile']['unit'])),
        ),
      );

      $t_selectors = array(
        " .affiliate-notification-inner" => array(
          'width' => AFFILIATE_Helper::get_css_value($attr['customWidthTablet'], $attr['customWidthTypeTablet']),
        ),
        " .affiliate-notification-content" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeTablet'], $attr['cntnfontSizeTypeTablet']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightTablet']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingTablet'], $attr['cntnletterSpacingTypeTablet']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorderTablet']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusTablet']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusTablet']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadiusTablet']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])),
          'padding' => AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['top'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['right'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['left'], AFFILIATE_Helper::get_css_value($attr['cntnPaddingTablet']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['top'], AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['right'], AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['left'], AFFILIATE_Helper::get_css_value($attr['cntnMarginTablet']['unit'])),
        ),
      );


      // @codingStandardsIgnoreEnd

      $regenerate_d = AFFILIATE_Helper::regenerate_stylesheet($selectors);
      $regenerate_m = AFFILIATE_Helper::regenerate_stylesheet($t_selectors);
      $regenerate_t = AFFILIATE_Helper::regenerate_stylesheet($m_selectors);

      $desktop = AFFILIATE_Helper::generate_css( $regenerate_d, '#affiliate-style-' . $id );

      $tablet = AFFILIATE_Helper::generate_css( $regenerate_t, '#affiliate-style-' . $id );

      $mobile = AFFILIATE_Helper::generate_css( $regenerate_m, '#affiliate-style-' . $id );

      $generated_css = array(
        'desktop' => $desktop,
        'tablet'  => $tablet,
        'mobile'  => $mobile,
      );
      return $generated_css;
    }

    public static function blocks_abnotification_gfont($attr)
    {
      $cntn_load_google_font = isset($attr['cntnLoadGoogleFonts']) ? $attr['cntnLoadGoogleFonts'] : '';
      $cntn_font_family      = isset($attr['cntnfontFamily']) ? $attr['cntnfontFamily'] : '';
      $cntn_font_weight      = isset($attr['cntnfontWeight']) ? $attr['cntnfontWeight'] : '';
      $cntn_font_subset      = isset($attr['cntnfontSubset']) ? $attr['cntnfontSubset'] : '';

      AFFILIATE_Helper::blocks_google_font($cntn_load_google_font, $cntn_font_family, $cntn_font_weight, $cntn_font_subset);
    }

    public static function blocks_propcons_gfont($attr)
    {

      $title_load_google_font = isset($attr['titleLoadGoogleFonts']) ? $attr['titleLoadGoogleFonts'] : '';
      $title_font_family      = isset($attr['titlefontFamily']) ? $attr['titlefontFamily'] : '';
      $title_font_weight      = isset($attr['titlefontWeight']) ? $attr['titlefontWeight'] : '';
      $title_font_subset      = isset($attr['titlefontSubset']) ? $attr['titlefontSubset'] : '';

      $list_load_google_font = isset($attr['listLoadGoogleFonts']) ? $attr['listLoadGoogleFonts'] : '';
      $list_font_family      = isset($attr['listfontFamily']) ? $attr['listfontFamily'] : '';
      $list_font_weight      = isset($attr['listfontWeight']) ? $attr['listfontWeight'] : '';
      $list_font_subset      = isset($attr['listfontSubset']) ? $attr['listfontSubset'] : '';

      AFFILIATE_Helper::blocks_google_font($title_load_google_font, $title_font_family, $title_font_weight, $title_font_subset);
      AFFILIATE_Helper::blocks_google_font($list_load_google_font, $list_font_family, $list_font_weight, $list_font_subset);
    }

    public static function get_abnotice_css( $attr, $id ) { 			// @codingStandardsIgnoreStart

      $defaults = AFFILIATE_Helper::$block_list['affiliate-booster/ab-notice-box']['attributes'];
      
      $attr = array_merge( $defaults, $attr );

      $m_selectors = array();
      $t_selectors = array();
      
      $boxshadow = array();
      if (!empty($attr['boxShadow']['openShadow']) && $attr['boxShadow']['openShadow'] == 1) {
        if ($attr['boxShadow']['inset'] === 0) {
          $inset = '';
        } else {
          $inset = $attr['boxShadow']['inset'];
        }
        $boxshadow = array(AFFILIATE_Helper::get_css_value($inset) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['horizontal'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['vertical'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['blur'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['spread'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['color']));
      }


      $selectors = array(
        " .affiliate-notice-inner" => array(
          "box-shadow"=>implode(',',$boxshadow),
          "border-color" => AFFILIATE_Helper::get_css_value($attr['titleBorderColor']),
          "border-style" => AFFILIATE_Helper::get_css_value($attr['titleBorderType']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['titleBorder']['top'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorder']['right'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorder']['bottom'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorder']['left'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['top'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['right'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['bottom'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['left'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])),
        ),
        " .affiliate-notice-title " => array( 
          "background" => AFFILIATE_Helper::get_css_value($attr['noticeTitleBgColor']),
        ),  
        " .affiliate-notice-title " . $attr['titleTag1']  => array(
          'font-family' => AFFILIATE_Helper::get_css_value($attr['titlefontFamily']),
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeDesktop'], $attr['titlefontSizeType']),
          'font-weight' => AFFILIATE_Helper::get_css_value($attr['titlefontWeight']),
          'font-style' => AFFILIATE_Helper::get_css_value($attr['titlefontStyle']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeight']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacing'], $attr['titleletterSpacingType']),
          'text-decoration' => AFFILIATE_Helper::get_css_value($attr['titletextDecoration']),
          'text-transform' => AFFILIATE_Helper::get_css_value($attr['titletextTransform']),
          "color" => AFFILIATE_Helper::get_css_value($attr['titleTextColor']),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['titleAlignment']),
          'padding' => AFFILIATE_Helper::get_css_value($attr['titlePadding']['top'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titlePadding']['right'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titlePadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titlePadding']['left'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['titleMargin']['top'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleMargin']['right'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleMargin']['left'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])),
        ),
        " .affiliate-notice-content li:before" => array(
          "color" => AFFILIATE_Helper::get_css_value($attr['iconColor']),
        ),
        " .affiliate-notice-cntn-wrapper" => array(
         "background" => AFFILIATE_Helper::get_css_value($attr['cntnBgColor']),
       ),
        " .affiliate-notice-content, .affiliate-notice-content li" => array(
          'font-family' => AFFILIATE_Helper::get_css_value($attr['cntnfontFamily']),
          'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeDesktop'], $attr['cntnfontSizeType']),
          'font-weight' => AFFILIATE_Helper::get_css_value($attr['cntnfontWeight']),
          'font-style' => AFFILIATE_Helper::get_css_value($attr['cntnfontStyle']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeight']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacing'], $attr['cntnletterSpacingType']),
          'text-decoration' => AFFILIATE_Helper::get_css_value($attr['cntntextDecoration']),
          'text-transform' => AFFILIATE_Helper::get_css_value($attr['cntntextTransform']),
          "color" => AFFILIATE_Helper::get_css_value($attr['cntnTextColor']),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['cntnAlignment']),
          "border-color" => AFFILIATE_Helper::get_css_value($attr['cntnBorderColor']),
          "border-style" => AFFILIATE_Helper::get_css_value($attr['cntnBorderType']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['cntnBorder']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorder']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorder']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorder']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorder']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['top'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['right'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['left'], AFFILIATE_Helper::get_css_value($attr['cntnBorderRadius']['unit'])),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['cntnAlignment']),
          'padding' => AFFILIATE_Helper::get_css_value($attr['cntnPadding']['top'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPadding']['right'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnPadding']['left'], AFFILIATE_Helper::get_css_value($attr['cntnPadding']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['cntnMargin']['top'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMargin']['right'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['cntnMargin']['left'], AFFILIATE_Helper::get_css_value($attr['cntnMargin']['unit'])),
        ),
      );


      $m_selectors = array(
        " .affiliate-notice-title " . $attr['titleTag1'] => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeMobile'], $attr['titlefontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingMobile'], $attr['titleletterSpacingTypeMobile']),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['titleAlignmentMobile']),
        ),
        " .affiliate-notice-content, .affiliate-notice-content li" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeMobile'], $attr['cntnfontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingMobile'], $attr['cntnletterSpacingTypeMobile']),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['cntnAlignmentMobile']),
        ),
      );

      $t_selectors = array(
       " .affiliate-notice-title " . $attr['titleTag1'] => array(
        'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeTablet'], $attr['titlefontSizeTypeTablet']),
        'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightTablet']),
        'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingTablet'], $attr['titleletterSpacingTypeTablet']),
      ),
       " .affiliate-notice-content, .affiliate-notice-content li" => array(
        'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeTablet'], $attr['cntnfontSizeTypeTablet']),
        'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightTablet']),
        'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingTablet'], $attr['cntnletterSpacingTypeTablet']),
      ),
      );


			// @codingStandardsIgnoreEnd

      $regenerate_d = AFFILIATE_Helper::regenerate_stylesheet($selectors);
      $regenerate_m = AFFILIATE_Helper::regenerate_stylesheet($t_selectors);
      $regenerate_t = AFFILIATE_Helper::regenerate_stylesheet($m_selectors);

      $desktop = AFFILIATE_Helper::generate_css( $regenerate_d, '#affiliate-style-' . $id );

      $tablet = AFFILIATE_Helper::generate_css( $regenerate_t, '#affiliate-style-' . $id );

      $mobile = AFFILIATE_Helper::generate_css( $regenerate_m, '#affiliate-style-' . $id );

      $generated_css = array(
        'desktop' => $desktop,
        'tablet'  => $tablet,
        'mobile'  => $mobile,
      );
      return $generated_css;
    }

    public static function blocks_abnotice_gfont($attr)
    {
      $title_load_google_font = isset($attr['titleLoadGoogleFonts']) ? $attr['titleLoadGoogleFonts'] : '';
      $title_font_family      = isset($attr['titlefontFamily']) ? $attr['titlefontFamily'] : '';
      $title_font_weight      = isset($attr['titlefontWeight']) ? $attr['titlefontWeight'] : '';
      $title_font_subset      = isset($attr['titlefontSubset']) ? $attr['titlefontSubset'] : '';

      $cntn_load_google_font = isset($attr['cntnLoadGoogleFonts']) ? $attr['cntnLoadGoogleFonts'] : '';
      $cntn_font_family      = isset($attr['cntnfontFamily']) ? $attr['cntnfontFamily'] : '';
      $cntn_font_weight      = isset($attr['cntnfontWeight']) ? $attr['cntnfontWeight'] : '';
      $cntn_font_subset      = isset($attr['cntnfontSubset']) ? $attr['cntnfontSubset'] : '';

      AFFILIATE_Helper::blocks_google_font($title_load_google_font, $title_font_family, $title_font_weight, $title_font_subset);
      AFFILIATE_Helper::blocks_google_font($cntn_load_google_font, $cntn_font_family, $cntn_font_weight, $cntn_font_subset);
    }

    public static function get_abbutton_css( $attr, $id ) { 			// @codingStandardsIgnoreStart

     $defaults = AFFILIATE_Helper::$block_list['affiliate-booster/ab-advance-button']['attributes'];

     $attr = array_merge( $defaults, $attr );

     $m_selectors = array();
     $t_selectors = array();

     $btnBg = '';
      if($attr['btnBg']['openBg'] == 1){
          if($attr['btnBg']['bgType'] == 'color'){
             $btnBg = $attr['btnBg']['bgDefaultColor']; 
          }
      } 

      $btnBgHover = '';
      if($attr['btnBgHover']['openBg'] == 1){
          if($attr['btnBgHover']['bgType'] == 'color'){
             $btnBgHover = $attr['btnBgHover']['bgDefaultColor']; 
          }
      } 

      $btnShadow = array();
        if (!empty($attr['btnShadow']['openShadow']) && $attr['btnShadow']['openShadow'] == 1) {
          if ($attr['btnShadow']['inset'] === 0) {
            $inset = '';
          } else {
            $inset = $attr['btnShadow']['inset'];
          }
          $btnShadow = array(AFFILIATE_Helper::get_css_value($inset) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnShadow']['horizontal'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnShadow']['vertical'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnShadow']['blur'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnShadow']['spread'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnShadow']['color']));
        }

     $selectors = array(
      " .affiliate-abbtn" => array(
        "box-shadow" => implode('',$btnShadow),
        'font-family' => AFFILIATE_Helper::get_css_value($attr['titlefontFamily']),
        'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeDesktop'], $attr['titlefontSizeType']),
        'font-weight' => AFFILIATE_Helper::get_css_value($attr['titlefontWeight']),
        'font-style' => AFFILIATE_Helper::get_css_value($attr['titlefontStyle']),
        'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeight']),
        'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacing'], $attr['titleletterSpacingType']),
        'text-decoration' => AFFILIATE_Helper::get_css_value($attr['titletextDecoration']),
        'text-transform' => AFFILIATE_Helper::get_css_value($attr['titletextTransform']),
        "color" => AFFILIATE_Helper::get_css_value($attr['titleTextColor']),
        "background" => AFFILIATE_Helper::get_css_value($btnBg),
        "border-color" => AFFILIATE_Helper::get_css_value($attr['titleBorderColor']),
        "border-style" => AFFILIATE_Helper::get_css_value($attr['titleBorderType']),
        "border-width" => AFFILIATE_Helper::get_css_value($attr['titleBorder']['top'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorder']['right'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorder']['bottom'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorder']['left'], AFFILIATE_Helper::get_css_value($attr['titleBorder']['unit'])),
        "border-radius" => AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['top'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['right'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['bottom'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['left'], AFFILIATE_Helper::get_css_value($attr['titleBorderRadius']['unit'])),
        "text-align" => AFFILIATE_Helper::get_css_value($attr['titleAlignment']),
        'padding' => AFFILIATE_Helper::get_css_value($attr['titlePadding']['top'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titlePadding']['right'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titlePadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titlePadding']['left'], AFFILIATE_Helper::get_css_value($attr['titlePadding']['unit'])),
        'margin' => AFFILIATE_Helper::get_css_value($attr['titleMargin']['top'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleMargin']['right'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['titleMargin']['left'], AFFILIATE_Helper::get_css_value($attr['titleMargin']['unit'])),
        ),
        " .affiliate-abbtn-inner" => array(
          "justify-content" => AFFILIATE_Helper::get_css_value($attr['titleAlignment']),
        ),
        " .affiliate-abbtn:hover" => array(
          "color" => AFFILIATE_Helper::get_css_value($attr['titleTextHoverColor']),
          "background" => AFFILIATE_Helper::get_css_value($btnBgHover),
          "border-color" => AFFILIATE_Helper::get_css_value($attr['titleBorderHoverColor']),
        ),
      );

     
       $m_selectors = array(
        " .affiliate-abbtn" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeMobile'], $attr['titlefontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingMobile'], $attr['titleletterSpacingTypeMobile']),
          "text-align" => AFFILIATE_Helper::get_css_value($attr['titleAlignmentMobile']),
        ),
      );

       $t_selectors = array(
         " .affiliate-abbtn" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeTablet'], $attr['titlefontSizeTypeTablet']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightTablet']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingTablet'], $attr['titleletterSpacingTypeTablet']),
        ),
       );

       if($attr['btnBg']['openBg'] == 1){
        if($attr['btnBg']['bgType'] == 'gradient'){
          if ($attr['btnBg']['bgGradient']['type'] == 'linear') {
            $selectors[" .affiliate-abbtn"]["background"] = 'linear-gradient(' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['direction'], 'deg,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['stop'], '%') . ')';
          } else {
            $selectors[" .affiliate-abbtn"]["background"] = 'radial-gradient( circle at ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['radial'], ',') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['stop'], '%') . ')';
          }
        }
      }  


      if($attr['btnBgHover']['openBg'] == 1){
        if($attr['btnBgHover']['bgType'] == 'gradient'){
          if ($attr['btnBgHover']['bgGradient']['type'] == 'linear') {
            $selectors[" .affiliate-abbtn:hover"]["background"] = 'linear-gradient(' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['direction'], 'deg,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['stop'], '%') . ')';
          } else {
            $selectors[" .affiliate-abbtn:hover"]["background"] = 'radial-gradient( circle at ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['radial'], ',') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['stop'], '%') . ')';
          }
        }
      }  


			// @codingStandardsIgnoreEnd

       $regenerate_d = AFFILIATE_Helper::regenerate_stylesheet($selectors);
       $regenerate_m = AFFILIATE_Helper::regenerate_stylesheet($t_selectors);
       $regenerate_t = AFFILIATE_Helper::regenerate_stylesheet($m_selectors);

       $desktop = AFFILIATE_Helper::generate_css( $regenerate_d, '#affiliate-style-' . $id );

       $tablet = AFFILIATE_Helper::generate_css( $regenerate_t, '#affiliate-style-' . $id );

       $mobile = AFFILIATE_Helper::generate_css( $regenerate_m, '#affiliate-style-' . $id );

       $generated_css = array(
        'desktop' => $desktop,
        'tablet'  => $tablet,
        'mobile'  => $mobile,
      );
       return $generated_css;
    }

    public static function blocks_abbutton_gfont($attr) {
      $title_load_google_font = isset($attr['titleLoadGoogleFonts']) ? $attr['titleLoadGoogleFonts'] : '';
      $title_font_family      = isset($attr['titlefontFamily']) ? $attr['titlefontFamily'] : '';
      $title_font_weight      = isset($attr['titlefontWeight']) ? $attr['titlefontWeight'] : '';
      $title_font_subset      = isset($attr['titlefontSubset']) ? $attr['titlefontSubset'] : '';

      AFFILIATE_Helper::blocks_google_font($title_load_google_font, $title_font_family, $title_font_weight, $title_font_subset);
    }

    public static function get_starating_css( $attr, $id ) {
      // @codingStandardsIgnoreStart

      $defaults = AFFILIATE_Helper::$block_list['affiliate-booster/ab-star-rating']['attributes'];

      $attr = array_merge( $defaults, $attr );
      
      $m_selectors = array();
      $t_selectors = array();
      
      $selectors = array(
        " .affiliate-star-inner-container" => array(
          "justify-content" => AFFILIATE_Helper::get_css_value($attr['ratingAlignemt']), 
        ),
        " .affiliate-star-item svg" => array(
          "height" => AFFILIATE_Helper::get_css_value($attr['starsSize'], 'px'),  
          "width" => AFFILIATE_Helper::get_css_value($attr['starsSize'], 'px'),
        ),

        " .affiliate-star-item:not(:last-child)" => array(
          'padding-right' => AFFILIATE_Helper::get_css_value($attr['itemPadding'], 'px'),
        ),
      );
      
      $m_selectors = array(
        " .affiliate-star-inner-container" => array(
          "justify-content" => AFFILIATE_Helper::get_css_value($attr['ratingAlignemtMobile']),  
        ),
        " .affiliate-star-item svg" => array(
          "height" => AFFILIATE_Helper::get_css_value($attr['starsSizeMobile'], 'px'),  
          "width" => AFFILIATE_Helper::get_css_value($attr['starsSizeMobile'], 'px'),
        ),

        " .affiliate-star-item:not(:last-child)" => array(
          'padding-right' => AFFILIATE_Helper::get_css_value($attr['itemPaddingMobile'], 'px'),
        ),
      );

      $t_selectors = array(
        " .affiliate-star-inner-container" => array(
          "justify-content" => AFFILIATE_Helper::get_css_value($attr['ratingAlignemtTablet']),  
        ),
        " .affiliate-star-item svg" => array(
          "height" => AFFILIATE_Helper::get_css_value($attr['starsSizeTablet'], 'px'),  
          "width" => AFFILIATE_Helper::get_css_value($attr['starsSizeTablet'], 'px'),
        ),

        " .affiliate-star-item:not(:last-child)" => array(
          'padding-right' => AFFILIATE_Helper::get_css_value($attr['itemPaddingTablet'], 'px'),
        ),
      );
      
      $regenerate_d = AFFILIATE_Helper::regenerate_stylesheet($selectors);
      $regenerate_t = AFFILIATE_Helper::regenerate_stylesheet($t_selectors);
      $regenerate_m = AFFILIATE_Helper::regenerate_stylesheet($m_selectors);

      $desktop = AFFILIATE_Helper::generate_css( $regenerate_d, '#affiliate-style-' . $id );

      $tablet = AFFILIATE_Helper::generate_css( $regenerate_t, '#affiliate-style-' . $id );

      $mobile = AFFILIATE_Helper::generate_css( $regenerate_m, '#affiliate-style-' . $id );

      $generated_css = array(
        'desktop' => $desktop,
        'tablet'  => $tablet,
        'mobile'  => $mobile,
      );
      return $generated_css;
    }

    public static function get_sp_css( $attr, $id ) {       // @codingStandardsIgnoreStart

        $inset = '';
        $defaults = AFFILIATE_Helper::$block_list['affiliate-booster/ab-single-product']['attributes'];

        $attr = array_merge( $defaults, $attr );

        $btnBg = '';
        if($attr['btnBg']['openBg'] == 1){
            if($attr['btnBg']['bgType'] == 'color'){
               $btnBg = $attr['btnBg']['bgDefaultColor']; 
            }
        } 

        $btnBgHover = '';
        if($attr['btnBgHover']['openBg'] == 1){
            if($attr['btnBgHover']['bgType'] == 'color'){
               $btnBgHover = $attr['btnBgHover']['bgDefaultColor']; 
            }
        } 

        $m_selectors = array();
        $t_selectors = array();

        $boxshadow = array();
        if (!empty($attr['boxShadow']['openShadow']) && $attr['boxShadow']['openShadow'] == 1) {
          if ($attr['boxShadow']['inset'] === 0) {
            $inset = '';
          } else {
            $inset = $attr['boxShadow']['inset'];
          }
          $boxshadow = array(AFFILIATE_Helper::get_css_value($inset) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['horizontal'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['vertical'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['blur'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['spread'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['color']));
        }

        $selectors = array(
          " .affiliate-sp-wrapper" => array(
            'padding' => AFFILIATE_Helper::get_css_value($attr['boxPadding']['top'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPadding']['right'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPadding']['left'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])),
            'margin' => AFFILIATE_Helper::get_css_value($attr['boxMargin']['top'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMargin']['right'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMargin']['left'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])),
            'border-style' => AFFILIATE_Helper::get_css_value($attr['boxBorderType']),
            'border-color' => AFFILIATE_Helper::get_css_value($attr['boxBorderColor']),
            'border-width' => AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['top'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['right'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['left'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])),
            "box-shadow"=>implode(',',$boxshadow),
            "background"=>AFFILIATE_Helper::get_css_value($attr['boxBackgroundColor']),
          ),
          " .affiliate-sp-image" => array(
            'padding' => AFFILIATE_Helper::get_css_value($attr['imagePadding']['top'], AFFILIATE_Helper::get_css_value($attr['imagePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePadding']['right'], AFFILIATE_Helper::get_css_value($attr['imagePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['imagePadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePadding']['left'], AFFILIATE_Helper::get_css_value($attr['imagePadding']['unit'])),
          ),
          " .affiliate-sp-image img" => array(
            'width' => AFFILIATE_Helper::get_css_value($attr['customImgWidth'],'px'),
          ),
          " .affiliate-list li:before" => array(
            'color' => AFFILIATE_Helper::get_css_value($attr['iconColor']),
          ),
          " .affiliate-sp-title" => array(
            'font-family' => AFFILIATE_Helper::get_css_value($attr['titlefontFamily']),
            'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeDesktop'], $attr['titlefontSizeType']),
            'font-weight' => AFFILIATE_Helper::get_css_value($attr['titlefontWeight']),
            'font-style' => AFFILIATE_Helper::get_css_value($attr['titlefontStyle']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeight']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacing'], $attr['titleletterSpacingType']),
            'text-decoration' => AFFILIATE_Helper::get_css_value($attr['titletextDecoration']),
            'text-transform' => AFFILIATE_Helper::get_css_value($attr['titletextTransform']),
            "color" => AFFILIATE_Helper::get_css_value($attr['titleTextColor']),
            "text-align" => AFFILIATE_Helper::get_css_value($attr['titleAlignment']),
          ),
          " .affiliate-sp-subtitle" => array(
            'font-family' => AFFILIATE_Helper::get_css_value($attr['subtitlefontFamily']),
            'font-size' => AFFILIATE_Helper::get_css_value($attr['subtitlefontSizeDesktop'], $attr['subtitlefontSizeType']),
            'font-weight' => AFFILIATE_Helper::get_css_value($attr['subtitlefontWeight']),
            'font-style' => AFFILIATE_Helper::get_css_value($attr['subtitlefontStyle']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['subtitlelineHeight']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['subtitleletterSpacing'], $attr['subtitleletterSpacingType']),
            'text-decoration' => AFFILIATE_Helper::get_css_value($attr['subtitletextDecoration']),
            'text-transform' => AFFILIATE_Helper::get_css_value($attr['subtitletextTransform']),
            "color" => AFFILIATE_Helper::get_css_value($attr['subtitleTextColor']),
            "text-align" => AFFILIATE_Helper::get_css_value($attr['subtitleAlignment']),
          ),
          " .affiliate-sp-content li, .affiliate-pr-pcontent" => array(
            'font-family' => AFFILIATE_Helper::get_css_value($attr['cntnfontFamily']),
            'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeDesktop'], $attr['cntnfontSizeType']),
            'font-weight' => AFFILIATE_Helper::get_css_value($attr['cntnfontWeight']),
            'font-style' => AFFILIATE_Helper::get_css_value($attr['cntnfontStyle']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeight']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacing'], $attr['cntnletterSpacingType']),
            'text-decoration' => AFFILIATE_Helper::get_css_value($attr['cntntextDecoration']),
            'text-transform' => AFFILIATE_Helper::get_css_value($attr['cntntextTransform']),
            "color" => AFFILIATE_Helper::get_css_value($attr['cntnTextColor']),
            "text-align" => AFFILIATE_Helper::get_css_value($attr['cntnAlignment']),
          ),
          " .affiliate-sp-btn" => array(
            'font-family' => AFFILIATE_Helper::get_css_value($attr['btnfontFamily']),
            'font-size' => AFFILIATE_Helper::get_css_value($attr['btnfontSizeDesktop'], $attr['btnfontSizeType']),
            'font-weight' => AFFILIATE_Helper::get_css_value($attr['btnfontWeight']),
            'font-style' => AFFILIATE_Helper::get_css_value($attr['btnfontStyle']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['btnlineHeight']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['btnletterSpacing'], $attr['btnletterSpacingType']),
            'text-decoration' => AFFILIATE_Helper::get_css_value($attr['btntextDecoration']),
            'text-transform' => AFFILIATE_Helper::get_css_value($attr['btntextTransform']),
            "background" => AFFILIATE_Helper::get_css_value($btnBg),
            "border-color" => AFFILIATE_Helper::get_css_value($attr['btnBorderColor']),
            "color" => AFFILIATE_Helper::get_css_value($attr['btnTextColor']),
            "border-style" => AFFILIATE_Helper::get_css_value($attr['btnBorderType']),
            "border-width" => AFFILIATE_Helper::get_css_value($attr['btnBorder']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorder']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorder']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorder']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])),
            "border-radius" => AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])),
            'padding' => AFFILIATE_Helper::get_css_value($attr['btnPadding']['top'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPadding']['right'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPadding']['left'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])),
            'margin' => AFFILIATE_Helper::get_css_value($attr['btnMargin']['top'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMargin']['right'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMargin']['left'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])),
          ),
          " .affiliate-sp-btn:hover" => array(
            "color" => AFFILIATE_Helper::get_css_value($attr['btnTextHoverColor']),
            "background" => AFFILIATE_Helper::get_css_value($btnBgHover),
            "border-color" => AFFILIATE_Helper::get_css_value($attr['btnBorderHoverColor']),
          ),
        );


        $m_selectors = array(
          " .affiliate-sp-wrapper" => array(
            'padding' => AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['top'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['right'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['left'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])),
            'margin' => AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['top'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['right'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['left'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])),
          ),
          " .affiliate-sp-image" => array(
           'padding' => AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['top'], AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['right'], AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['left'], AFFILIATE_Helper::get_css_value($attr['imagePaddingMobile']['unit'])),
         ),
          " .affiliate-sp-image img" => array(
            'width' => AFFILIATE_Helper::get_css_value($attr['customImgWidthMobile'],'px'),
          ),
          " .affiliate-sp-title" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeMobile'], $attr['titlefontSizeTypeMobile']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightMobile']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingMobile'], $attr['titleletterSpacingTypeMobile']),
            "text-align" => AFFILIATE_Helper::get_css_value($attr['titleAlignmentMobile']),
          ),
          " .affiliate-sp-subtitle" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['subtitlefontSizeMobile'], $attr['subtitlefontSizeTypeMobile']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['subtitlelineHeightMobile']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['subtitleletterSpacingMobile'], $attr['subtitleletterSpacingTypeMobile']),
            "text-align" => AFFILIATE_Helper::get_css_value($attr['subtitleAlignmentMobile']),
          ),
          " .affiliate-sp-content li, .affiliate-pr-pcontent" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeMobile'], $attr['cntnfontSizeTypeMobile']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightMobile']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingMobile'], $attr['cntnletterSpacingTypeMobile']),
            "text-align" => AFFILIATE_Helper::get_css_value($attr['cntnAlignmentMobile']),
          ),
          " .affiliate-sp-btn" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['btnfontSizeMobile'], $attr['btnfontSizeTypeMobile']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['btnlineHeightMobile']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['btnletterSpacingMobile'], $attr['btnletterSpacingTypeMobile']),
            "border-width" => AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])),
            "border-radius" => AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])),
            'padding' => AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])),
            'margin' => AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])),
          ),
        );

        $t_selectors = array(
          " .affiliate-sp-wrapper" => array(
            'padding' => AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['top'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['right'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['left'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])),
            'margin' => AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['top'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['right'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['left'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])),
          ),
          " .affiliate-sp-title" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeTablet'], $attr['titlefontSizeTypeTablet']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightTablet']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingTablet'], $attr['titleletterSpacingTypeTablet']),
          ),
          " .affiliate-sp-image" => array(
            'padding' => AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['top'], AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['right'], AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['left'], AFFILIATE_Helper::get_css_value($attr['imagePaddingTablet']['unit'])),
          ),
          " .affiliate-sp-image img" => array(
            'width' => AFFILIATE_Helper::get_css_value($attr['customImgWidthTablet'],'px'),
          ),
          " .affiliate-sp-subtitle" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['subtitlefontSizeTablet'], $attr['subtitlefontSizeTypeTablet']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['subtitlelineHeightTablet']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['subtitleletterSpacingTablet'], $attr['subtitleletterSpacingTypeTablet']),
          ),
          " .affiliate-sp-content li, .affiliate-pr-pcontent" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeTablet'], $attr['cntnfontSizeTypeTablet']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightTablet']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingTablet'], $attr['cntnletterSpacingTypeTablet']),
          ),
          " .affiliate-sp-btn" => array(
            'font-size' => AFFILIATE_Helper::get_css_value($attr['btnfontSizeTablet'], $attr['btnfontSizeTypeTablet']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['btnlineHeightTablet']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['btnletterSpacingTablet'], $attr['btnletterSpacingTypeTablet']),
            "border-width" => AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])),
            "border-radius" => AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])),
            'padding' => AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])),
            'margin' => AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])),
          ),
        );


        if($attr['btnBg']['openBg'] == 1){
        if($attr['btnBg']['bgType'] == 'gradient'){
          if ($attr['btnBg']['bgGradient']['type'] == 'linear') {
            $selectors[" .affiliate-sp-btn"]["background"] = 'linear-gradient(' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['direction'], 'deg,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['stop'], '%') . ')';
          } else {
            $selectors[" .affiliate-sp-btn"]["background"] = 'radial-gradient( circle at ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['radial'], ',') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['stop'], '%') . ')';
          }
        }
      }  


      if($attr['btnBgHover']['openBg'] == 1){
        if($attr['btnBgHover']['bgType'] == 'gradient'){
          if ($attr['btnBgHover']['bgGradient']['type'] == 'linear') {
            $selectors[" .affiliate-sp-btn:hover"]["background"] = 'linear-gradient(' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['direction'], 'deg,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['stop'], '%') . ')';
          } else {
            $selectors[" .affiliate-sp-btn:hover"]["background"] = 'radial-gradient( circle at ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['radial'], ',') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['stop'], '%') . ')';
          }
        }
      }  
        
        // @codingStandardsIgnoreEnd

        $regenerate_d = AFFILIATE_Helper::regenerate_stylesheet($selectors);
        $regenerate_m = AFFILIATE_Helper::regenerate_stylesheet($t_selectors);
        $regenerate_t = AFFILIATE_Helper::regenerate_stylesheet($m_selectors);

        $desktop = AFFILIATE_Helper::generate_css( $regenerate_d, '#affiliate-style-' . $id );

        $tablet = AFFILIATE_Helper::generate_css( $regenerate_t, '#affiliate-style-' . $id );

        $mobile = AFFILIATE_Helper::generate_css( $regenerate_m, '#affiliate-style-' . $id );

        $generated_css = array(
          'desktop' => $desktop,
          'tablet'  => $tablet,
          'mobile'  => $mobile,
        );
        return $generated_css;
    }

    public static function blocks_sp_gfont($attr)
    {

      $btn_load_google_font = isset($attr['btnLoadGoogleFonts']) ? $attr['btnLoadGoogleFonts'] : '';
      $btn_font_family      = isset($attr['btnfontFamily']) ? $attr['btnfontFamily'] : '';
      $btn_font_weight      = isset($attr['btnfontWeight']) ? $attr['btnfontWeight'] : '';
      $btn_font_subset      = isset($attr['btnfontSubset']) ? $attr['btnfontSubset'] : '';

      $title_load_google_font = isset($attr['titleLoadGoogleFonts']) ? $attr['titleLoadGoogleFonts'] : '';
      $title_font_family      = isset($attr['titlefontFamily']) ? $attr['titlefontFamily'] : '';
      $title_font_weight      = isset($attr['titlefontWeight']) ? $attr['titlefontWeight'] : '';
      $title_font_subset      = isset($attr['titlefontSubset']) ? $attr['titlefontSubset'] : '';

      $cntn_load_google_font = isset($attr['cntnLoadGoogleFonts']) ? $attr['cntnLoadGoogleFonts'] : '';
      $cntn_font_family      = isset($attr['cntnfontFamily']) ? $attr['cntnfontFamily'] : '';
      $cntn_font_weight      = isset($attr['cntnfontWeight']) ? $attr['cntnfontWeight'] : '';
      $cntn_font_subset      = isset($attr['cntnfontSubset']) ? $attr['cntnfontSubset'] : '';

      $subtitle_load_google_font = isset($attr['subtitleLoadGoogleFonts']) ? $attr['subtitleLoadGoogleFonts'] : '';
      $subtitle_font_family      = isset($attr['subtitlefontFamily']) ? $attr['subtitlefontFamily'] : '';
      $subtitle_font_weight      = isset($attr['subtitlefontWeight']) ? $attr['subtitlefontWeight'] : '';
      $subtitle_font_subset      = isset($attr['subtitlefontSubset']) ? $attr['subtitlefontSubset'] : '';

      AFFILIATE_Helper::blocks_google_font($btn_load_google_font, $btn_font_family, $btn_font_weight, $btn_font_subset);
      AFFILIATE_Helper::blocks_google_font($title_load_google_font, $title_font_family, $title_font_weight, $title_font_subset);
      AFFILIATE_Helper::blocks_google_font($cntn_load_google_font, $cntn_font_family, $cntn_font_weight, $cntn_font_subset);
      AFFILIATE_Helper::blocks_google_font($subtitle_load_google_font, $subtitle_font_family, $subtitle_font_weight, $subtitle_font_subset);
    }

    public static function get_cta_css($attr, $id){    // @codingStandardsIgnoreStart
      
      $defaults = AFFILIATE_Helper::$block_list['affiliate-booster/ab-callto-action']['attributes'];

      $attr = array_merge($defaults, (array) $attr);

      $selectors = self::get_cta_selectors($attr);

      $m_selectors = self::get_cta_mobiletselectors($attr);

      $t_selectors = self::get_cta_tabletselectors($attr);
      // // @codingStandardsIgnoreEnd

      $desktop = AFFILIATE_Helper::generate_css($selectors, '#affiliate-style-' . $id);

      $tablet = AFFILIATE_Helper::generate_css($t_selectors, '#affiliate-style-' . $id);

      $mobile = AFFILIATE_Helper::generate_css($m_selectors, '#affiliate-style-' . $id);

      $generated_css = array(
        'desktop' => $desktop,
        'tablet'  => $tablet,
        'mobile'  => $mobile,
      );

      return $generated_css;
    }

    // CTA Desktop Selector
    public static function get_cta_selectors($attr){
     
      $background = $bgurl = $bg_position = $bg_repeat = $bg_size = '';
      if($attr['boxBg']['openBg'] == 1){
          if($attr['boxBg']['bgType'] == 'color'){
             $background = $attr['boxBg']['bgDefaultColor']; 
          }
          if($attr['boxBg']['bgType'] == 'image'){
            $background_img = $attr['boxBg']['bgImage']['url']; 
            $bg_position = $attr['boxBg']['bgimgPosition'];
            $bg_repeat = $attr['boxBg']['bgimgRepeat'];
            $bg_size =  $attr['boxBg']['bgimgSize'];
         }
      }

      $btnBg = '';
      if($attr['btnBg']['openBg'] == 1){
          if($attr['btnBg']['bgType'] == 'color'){
             $btnBg = $attr['btnBg']['bgDefaultColor']; 
          }
      } 

      $btnBgHover = '';
      if($attr['btnBgHover']['openBg'] == 1){
          if($attr['btnBgHover']['bgType'] == 'color'){
             $btnBgHover = $attr['btnBgHover']['bgDefaultColor']; 
          }
      } 

      $boxshadow = array();
        if (!empty($attr['boxShadow']['openShadow']) && $attr['boxShadow']['openShadow'] == 1) {
          if ($attr['boxShadow']['inset'] === 0) {
            $inset = '';
          } else {
            $inset = $attr['boxShadow']['inset'];
          }
          $boxshadow = array(AFFILIATE_Helper::get_css_value($inset) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['horizontal'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['vertical'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['blur'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['spread'], 'px') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxShadow']['color']));
        }

      
      $desktop_css = array(
        " .affiliate-cta-overlay" => array(
            'background-color'=> AFFILIATE_Helper::get_css_value($attr['bgOverlay']),
        ),
        " .affiliate-cta-btn-wrapper" => array(
            'justify-content' => AFFILIATE_Helper::get_css_value($attr['btnAlignment']),
        ),
        " .affiliate-cta-inner" => array(
            'padding' => AFFILIATE_Helper::get_css_value($attr['boxPadding']['top'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPadding']['right'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPadding']['left'], AFFILIATE_Helper::get_css_value($attr['boxPadding']['unit'])),
            'margin' => AFFILIATE_Helper::get_css_value($attr['boxMargin']['top'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMargin']['right'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMargin']['left'], AFFILIATE_Helper::get_css_value($attr['boxMargin']['unit'])),
            "background" => AFFILIATE_Helper::get_css_value($background),
            "background-image" => (isset( $background_img) && isset( $background_img ) ) ? 'url("'.$background_img.'")' : null,
            'background-position'=> AFFILIATE_Helper::get_css_value($bg_position),
            'background-repeat'=> AFFILIATE_Helper::get_css_value($bg_repeat),
            'background-size'=> AFFILIATE_Helper::get_css_value($bg_size),
            'text-align'=> AFFILIATE_Helper::get_css_value($attr['boxAlignment']),
            "box-shadow"=>implode(',',$boxshadow),

            'border-style' => AFFILIATE_Helper::get_css_value($attr['boxBorderType']),
            'border-color' => AFFILIATE_Helper::get_css_value($attr['boxBorderColor']),
            'border-width' => AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['top'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['right'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['left'], AFFILIATE_Helper::get_css_value($attr['boxBorderWidth']['unit'])),
            

        ),
        "  .affiliate-cta-inner p.affiliate-cta-title, .affiliate-cta-inner p.affiliate-cta-content" => array(
             'text-align'=> AFFILIATE_Helper::get_css_value($attr['boxAlignment']),
        ),
        " .affiliate-cta-title" => array(
            'font-family' => AFFILIATE_Helper::get_css_value($attr['titlefontFamily']),
            'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeDesktop'], $attr['titlefontSizeType']),
            'font-weight' => AFFILIATE_Helper::get_css_value($attr['titlefontWeight']),
            'font-style' => AFFILIATE_Helper::get_css_value($attr['titlefontStyle']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeight']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacing'], $attr['titleletterSpacingType']),
            'text-decoration' => AFFILIATE_Helper::get_css_value($attr['titletextDecoration']),
            'text-transform' => AFFILIATE_Helper::get_css_value($attr['titletextTransform']),
            "color" => AFFILIATE_Helper::get_css_value($attr['titleTextColor']),
        ),
        " .affiliate-cta-content" => array(
            'font-family' => AFFILIATE_Helper::get_css_value($attr['cntnfontFamily']),
            'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeDesktop'], $attr['cntnfontSizeType']),
            'font-weight' => AFFILIATE_Helper::get_css_value($attr['cntnfontWeight']),
            'font-style' => AFFILIATE_Helper::get_css_value($attr['cntnfontStyle']),
            'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeight']),
            'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacing'], $attr['cntnletterSpacingType']),
            'text-decoration' => AFFILIATE_Helper::get_css_value($attr['cntntextDecoration']),
            'text-transform' => AFFILIATE_Helper::get_css_value($attr['cntntextTransform']),
            "color" => AFFILIATE_Helper::get_css_value($attr['cntnTextColor']),
        ),

        " .affiliate-cta-btn" => array(
          'font-family' => AFFILIATE_Helper::get_css_value($attr['btnfontFamily']),
          'font-size' => AFFILIATE_Helper::get_css_value($attr['btnfontSizeDesktop'], $attr['btnfontSizeType']),
          'font-weight' => AFFILIATE_Helper::get_css_value($attr['btnfontWeight']),
          'font-style' => AFFILIATE_Helper::get_css_value($attr['btnfontStyle']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['btnlineHeight']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['btnletterSpacing'], $attr['btnletterSpacingType']),
          'text-decoration' => AFFILIATE_Helper::get_css_value($attr['btntextDecoration']),
          'text-transform' => AFFILIATE_Helper::get_css_value($attr['btntextTransform']),
          "background" => AFFILIATE_Helper::get_css_value($btnBg),
          "border-style" => AFFILIATE_Helper::get_css_value($attr['btnBorderType']),
          "border-color" => AFFILIATE_Helper::get_css_value($attr['btnBorderColor']),
          "color" => AFFILIATE_Helper::get_css_value($attr['btnTextColor']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['btnBorder']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorder']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorder']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorder']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorder']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadius']['unit'])),
          'padding' => AFFILIATE_Helper::get_css_value($attr['btnPadding']['top'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPadding']['right'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPadding']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPadding']['left'], AFFILIATE_Helper::get_css_value($attr['btnPadding']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['btnMargin']['top'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMargin']['right'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMargin']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMargin']['left'], AFFILIATE_Helper::get_css_value($attr['btnMargin']['unit'])),
        ),
        " .affiliate-cta-btn:hover" => array(
            "color" => AFFILIATE_Helper::get_css_value($attr['btnTextHoverColor']),
            "background" => AFFILIATE_Helper::get_css_value($btnBgHover),
            "border-color" => AFFILIATE_Helper::get_css_value($attr['btnBorderHoverColor']),
        ),
      );
      if($attr['boxBg']['openBg'] == 1){
        if($attr['boxBg']['bgType'] == 'gradient'){
          if ($attr['boxBg']['bgGradient']['type'] == 'linear') {
            $desktop_css[" .affiliate-cta-inner"]["background"] = 'linear-gradient(' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['direction'], 'deg,') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['stop'], '%') . ')';
          } else {
            $desktop_css[" .affiliate-cta-inner"]["background"] = 'radial-gradient( circle at ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['radial'], ',') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxBg']['bgGradient']['stop'], '%') . ')';
          }
        }
      }  


      if($attr['btnBg']['openBg'] == 1){
        if($attr['btnBg']['bgType'] == 'gradient'){
          if ($attr['btnBg']['bgGradient']['type'] == 'linear') {
            $desktop_css[" .affiliate-cta-btn"]["background"] = 'linear-gradient(' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['direction'], 'deg,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['stop'], '%') . ')';
          } else {
            $desktop_css[" .affiliate-cta-btn"]["background"] = 'radial-gradient( circle at ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['radial'], ',') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBg']['bgGradient']['stop'], '%') . ')';
          }
        }
      }  


      if($attr['btnBgHover']['openBg'] == 1){
        if($attr['btnBgHover']['bgType'] == 'gradient'){
          if ($attr['btnBgHover']['bgGradient']['type'] == 'linear') {
            $desktop_css[" .affiliate-cta-btn:hover"]["background"] = 'linear-gradient(' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['direction'], 'deg,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['stop'], '%') . ')';
          } else {
            $desktop_css[" .affiliate-cta-btn:hover"]["background"] = 'radial-gradient( circle at ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['radial'], ',') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color1']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['start'], '%,') . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['color2']) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBgHover']['bgGradient']['stop'], '%') . ')';
          }
        }
      }  

      $desktop_css =  AFFILIATE_Helper::regenerate_stylesheet($desktop_css);

      return $desktop_css;
    }

    // CTA Mobile Selector
    public static function get_cta_mobiletselectors($attr){
      $mobile_css = array(
        " .affiliate-cta-inner" => array(
          'padding' => AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['top'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['right'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['left'], AFFILIATE_Helper::get_css_value($attr['boxPaddingMobile']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['top'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['right'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['left'], AFFILIATE_Helper::get_css_value($attr['boxMarginMobile']['unit'])),
          'text-align'=> AFFILIATE_Helper::get_css_value($attr['boxAlignmentMobile']),  
        ),
        " .affiliate-cta-title" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeMobile'], $attr['titlefontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingMobile'], $attr['titleletterSpacingTypeMobile']),
      ),
        " .affiliate-cta-content" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeMobile'], $attr['cntnfontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingMobile'], $attr['cntnletterSpacingTypeMobile']),
        ),
        " .affiliate-cta-btn" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['btnfontSizeMobile'], $attr['btnfontSizeTypeMobile']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['btnlineHeightMobile']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['btnletterSpacingMobile'], $attr['btnletterSpacingTypeMobile']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderMobile']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusMobile']['unit'])),
          'padding' => AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnPaddingMobile']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['top'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['right'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['left'], AFFILIATE_Helper::get_css_value($attr['btnMarginMobile']['unit'])),
        ),
      );

      $mobile_css =  AFFILIATE_Helper::regenerate_stylesheet($mobile_css);

      return $mobile_css;
    }

    // CTA Content Selector
    public static function get_cta_tabletselectors($attr){
      
      
      $tablet_css = array(
        " .affiliate-cta-inner" => array(
          'padding' => AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['top'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['right'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['left'], AFFILIATE_Helper::get_css_value($attr['boxPaddingTablet']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['top'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['right'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['left'], AFFILIATE_Helper::get_css_value($attr['boxMarginTablet']['unit'])),
          'text-align'=> AFFILIATE_Helper::get_css_value($attr['boxAlignmentTablet']),  
        ),
        " .affiliate-cta-title" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['titlefontSizeTablet'], $attr['titlefontSizeTypeTablet']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['titlelineHeightTablet']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['titleletterSpacingTablet'], $attr['titleletterSpacingTypeTablet']),
      ),
        " .affiliate-cta-content" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['cntnfontSizeTablet'], $attr['cntnfontSizeTypeTablet']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['cntnlineHeightTablet']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['cntnletterSpacingTablet'], $attr['cntnletterSpacingTypeTablet']),
        ),
        " .affiliate-cta-btn" => array(
          'font-size' => AFFILIATE_Helper::get_css_value($attr['btnfontSizeTablet'], $attr['btnfontSizeTypeTablet']),
          'line-height' => AFFILIATE_Helper::get_css_value($attr['btnlineHeightTablet']),
          'letter-spacing' => AFFILIATE_Helper::get_css_value($attr['btnletterSpacingTablet'], $attr['btnletterSpacingTypeTablet']),
          "border-width" => AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderTablet']['unit'])),
          "border-radius" => AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnBorderRadiusTablet']['unit'])),
          'padding' => AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnPaddingTablet']['unit'])),
          'margin' => AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['top'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['right'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['bottom'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])) . ' ' . AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['left'], AFFILIATE_Helper::get_css_value($attr['btnMarginTablet']['unit'])),
        ),
      );

      $tablet_css =  AFFILIATE_Helper::regenerate_stylesheet($tablet_css);

      return $tablet_css;
    }

    public static function blocks_cta_gfont($attr)
    {

      $btn_load_google_font = isset($attr['btnLoadGoogleFonts']) ? $attr['btnLoadGoogleFonts'] : '';
      $btn_font_family      = isset($attr['btnfontFamily']) ? $attr['btnfontFamily'] : '';
      $btn_font_weight      = isset($attr['btnfontWeight']) ? $attr['btnfontWeight'] : '';
      $btn_font_subset      = isset($attr['btnfontSubset']) ? $attr['btnfontSubset'] : '';

      $title_load_google_font = isset($attr['titleLoadGoogleFonts']) ? $attr['titleLoadGoogleFonts'] : '';
      $title_font_family      = isset($attr['titlefontFamily']) ? $attr['titlefontFamily'] : '';
      $title_font_weight      = isset($attr['titlefontWeight']) ? $attr['titlefontWeight'] : '';
      $title_font_subset      = isset($attr['titlefontSubset']) ? $attr['titlefontSubset'] : '';

      $cntn_load_google_font = isset($attr['cntnLoadGoogleFonts']) ? $attr['cntnLoadGoogleFonts'] : '';
      $cntn_font_family      = isset($attr['cntnfontFamily']) ? $attr['cntnfontFamily'] : '';
      $cntn_font_weight      = isset($attr['cntnfontWeight']) ? $attr['cntnfontWeight'] : '';
      $cntn_font_subset      = isset($attr['cntnfontSubset']) ? $attr['cntnfontSubset'] : '';

      AFFILIATE_Helper::blocks_google_font($btn_load_google_font, $btn_font_family, $btn_font_weight, $btn_font_subset);
      AFFILIATE_Helper::blocks_google_font($title_load_google_font, $title_font_family, $title_font_weight, $title_font_subset);
      AFFILIATE_Helper::blocks_google_font($cntn_load_google_font, $cntn_font_family, $cntn_font_weight, $cntn_font_subset);
    }


  }
}
