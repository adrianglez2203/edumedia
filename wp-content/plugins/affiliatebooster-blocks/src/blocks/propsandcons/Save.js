const { Component } = wp.element;
// const { HelperFunction: { animationAttr, IsInteraction } } = wp.affiliateComponents
const {
    InspectorControls,
    BlockControls,
    RichText,
} = wp.blockEditor;

class Save extends Component {
    renderListItems = () => {
        const { attributes: { listItems, listItemsTwo } } = this.props

        return listItems.map(item => <li className={`affiliate-list-item`}>{item}</li>)
    
    }
    renderListItemsTwo = () => {
        const { attributes: {listItemsTwo } } = this.props

        return listItemsTwo.map(item => <li className={`affiliate-list-item`}>{item}</li>)
    
    }
    render() {
        const { attributes: { uniqueId, block_id,titleTag1, listTextItems, listTextItemsTwo, alignment,titlefontWeight, bulletStyle, bulletStyleTwo, listType, animation, interaction, consTitle, propsTitle } } = this.props
        const Tag1 = this.props.attributes.titleTag1
        // const interactionClass = IsInteraction(interaction) ? 'qubley-block-interaction' : '';
        const ListTag = listType == 'ordered' ? 'ol' : 'ul'
        return (
            <div id={`affiliate-style-${block_id}`} className={`affiliate-block-${uniqueId} affiliate-wrapper`}>
                <div className={`affiliate-d-table affiliate-procon-inner`}>
                    <div className={`affiliate-block-advanced-list affiliate-props-list affiliate-alignment-${alignment}`}>
                        <Tag1 className={`affiliate-props-title affiliate-propcon-title`}> { propsTitle } </Tag1>
                        <RichText.Content
                            tagName="ul"
                            multiline="li"
                            className={`affiliate-list affiliate-list-type-unordered affiliate-list-bullet-${bulletStyle.name}`}
                            value={ listTextItems }
                        />
                    </div>
                    <div className={`affiliate-block-advanced-list affiliate-cons-list affiliate-alignment-${alignment}`}>
                        <Tag1 className={`affiliate-const-title affiliate-propcon-title`}> { consTitle } </Tag1>
                        <RichText.Content
                            tagName="ul"
                            multiline="li"
                            className={`affiliate-list affiliate-list-type-unordered affiliate-list-bullet-${bulletStyleTwo.name}`}
                            value={ listTextItemsTwo }
                        /> 
                    </div>
                </div>
            </div>
        );
    }
}

export default Save;