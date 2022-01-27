<?php

namespace WPFunnels\Batch\Elementor;

use WPFunnels\Batch\Divi\Wpfnl_Divi_Source;
use WPFunnels\Batch\Gutenberg\Wpfnl_Gutenberg_Batch;
use WPFunnels\Batch\Gutenberg\Wpfnl_Gutenberg_Source;
use WPFunnels\Batch\Wpfnl_Divi_Batch;
use WPFunnels\Batch\Wpfnl_Elementor_Batch;
use WPFunnels\Wpfnl_functions;

class Wpfnl_Batch
{
    protected $elementor_batch;

    protected $elementor_source;

    protected $gutenberg_batch;

    protected $gutenberg_source;

	protected $divi_batch;

	protected $divi_source;

    public function __construct()
    {
        add_action('wpfunnels_after_step_import', [$this, 'start_processing'], 10, 2);

        if (class_exists('\Elementor\Plugin') || Wpfnl_functions::is_plugin_activated('elementor/elementor.php')) {
            $this->elementor_batch 	= new Wpfnl_Elementor_Batch();
            $this->elementor_source = new Wpfnl_Elementor_Source();
        }

        if ( ( Wpfnl_functions::get_builder_type() === 'gutenberg' ) ) {
            $this->gutenberg_batch 	= new Wpfnl_Gutenberg_Batch();
            $this->gutenberg_source = new Wpfnl_Gutenberg_Source();
        }

		if ( ( Wpfnl_functions::get_builder_type() === 'divi-builder' ) ) {
			$this->divi_batch 	= new Wpfnl_Divi_Batch();
			$this->divi_source 	= new Wpfnl_Divi_Source();
		}
    }

    /**
     * Start the batch import process
     *
     * @param int $step_id
     * @param string $builder
     * @since 1.0.0
     */
    public function start_processing($step_id = 0, $builder = 'elementor')
    {
    	if ($builder === 'elementor' && class_exists('\Elementor\Plugin')) {
            $this->elementor_batch->push_to_queue($step_id);
            $this->elementor_batch->save()->dispatch();
        }

        if ($builder === 'gutenberg') {
            $this->gutenberg_batch->push_to_queue($step_id);
            $this->gutenberg_batch->save()->dispatch();
        }

		if ($builder === 'divi-builder') {
			$this->divi_batch->push_to_queue($step_id);
			$this->divi_batch->save()->dispatch();
		}
    }
}
