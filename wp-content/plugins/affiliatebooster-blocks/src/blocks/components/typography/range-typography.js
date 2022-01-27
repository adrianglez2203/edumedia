/**
 * WordPress dependencies
 */
const { __ } = wp.i18n

const {
	RangeControl,
	ButtonGroup,
	Button,
	TabPanel,
	Dashicon,
} = wp.components

// Extend component
const { Component, Fragment } = wp.element

/**
 * Internal dependencies
 */
import map from "lodash/map"


function RangeTypographyControl( props ) {

	let sizeTypes

	if( "sizeTypes" in props ) {
		sizeTypes = props.sizeTypes
	} else {
		sizeTypes = [
			{ key: "px", name: __( "px" ) },
			{ key: "em", name: __( "em" ) },
			{ key: "rem", name: __( "rem" ) },
			{ key: "%", name: __( "%" ) },
		]
	}

	const sizeTypesControls = (
		<ButtonGroup className="affiliate-size-type-field" aria-label={ __( "Size Type" ) }>
			{ map( sizeTypes, ( { name, key } ) => (
				<Button
					key={ key }
					className="affiliate-size-btn"
					isSmall
					isPrimary={ props.type.value === key }
					aria-pressed={ props.type.value === key }
					onClick={ () => props.setAttributes( { [props.typeLabel]: key } ) }
				>
					{ name }
				</Button>
			) ) }
		</ButtonGroup>
	)

	return (
		<div className="aff-typography-range-options">

			<TabPanel className="affiliate-size-type-field-tabs" activeClass="active-tab"
				tabs={ [
					{
						name: "desktop",
						title: <Dashicon icon="desktop" />,
						className: "affiliate-desktop-tab affiliate-responsive-tabs",
					},
					{
						name: "tablet",
						title: <Dashicon icon="tablet" />,
						className: "affiliate-tablet-tab affiliate-responsive-tabs",
					},
					{
						name: "mobile",
						title: <Dashicon icon="smartphone" />,
						className: "affiliate-mobile-tab affiliate-responsive-tabs",
					},
				] }>
				{
					( tab ) => {
						let tabout

						if ( "mobile" === tab.name ) {
							tabout = (
								<Fragment>
									{sizeTypesControls}
									<RangeControl
										label={ __( props.sizeMobileText ) }
										value={ props.sizeMobile.value }
										onChange={ ( value ) => props.setAttributes( { [props.sizeMobileLabel]: value } ) }
										min={ 0 }
										max={ props.maxVal = props.maxVal ? props.maxVal : 100 }
										step={ props.steps }
										beforeIcon="editor-textcolor"
										allowReset
										// initialPosition={30}
									/>
								</Fragment>
							)
						} else if ( "tablet" === tab.name ) {
							tabout = (
								<Fragment>
									{sizeTypesControls}
									<RangeControl
										label={ __( props.sizeTabletText ) }
										value={ props.sizeTablet.value }
										onChange={ ( value ) => props.setAttributes( { [props.sizeTabletLabel]: value } ) }
										min={ 0 }
										max={ props.maxVal = props.maxVal ? props.maxVal : 100 }
										step={ props.steps }
										beforeIcon="editor-textcolor"
										allowReset
										// initialPosition={30}
									/>
								</Fragment>
							)
						} else {
							tabout = (
								<Fragment>
									{sizeTypesControls}
									<RangeControl
										label={ __( props.sizeText ) }
										value={ props.size.value }
										onChange={ ( value ) => props.setAttributes( { [props.sizeLabel]: value } ) }
										min={ 0 }
										max={ props.maxVal = props.maxVal ? props.maxVal : 100 }
										step={ props.steps }
										beforeIcon="editor-textcolor"
										allowReset
										// initialPosition={30}
									/>
								</Fragment>
							)
						}

						return <div>{ tabout }</div>
					}
				}
			</TabPanel>
		</div>
	)
}

export default RangeTypographyControl
