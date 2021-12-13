import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { el } from '@wordpress/element';

import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';

import { Button, ButtonGroup } from '@wordpress/components';



registerBlockType('posts-row/row-block', {
    apiVersion: 2,
    title: 'Posts Row Block',
    icon: 'admin-generic',
    category: 'design',
    attributes: {
        blockId: { type: 'string' },
        contentBefore: {
            type: 'array',
            source: 'children',
            selector: 'h3',
        },
        contentAfter: {
            type: 'array',
            source: 'children',
            selector: 'p',
        },
    },
    example: { // this is what shows up in the small preview from the block inserter
        attributes: {
            contentBefore: '🎉 Featured Posts',
            contentAfter: 'content after',
        },
    },
    edit: (props) => {

        const { attributes, attributes: { contentBefore }, attributes: { contentAfter }, setAttributes, clientId, className } = props;

        // const { blockId } = attributes;
        // if (!blockId) {
        //     setAttributes({ blockId: clientId });
        // }

        const blockProps = useBlockProps();
        const onChangeBeforeContent = (newContent) => {
            setAttributes({ contentBefore: newContent });

            fetch(
                '/wp-content/plugins/posts-row/api/?cat=news',
                {
                    headers: {
                        Accept: "text/plain", //Accept: "application/json"
                    }
                }
            )
                .then(response => response.text())
                .then(data => console.log(data))
        };
        // const onChangeAfterContent = (newContent) => {
        //     setAttributes({ contentAfter: newContent });
        // };

        const ALLOWED_BLOCKS = ['core/button', 'core/buttons', 'core/paragraph', 'core/heading', 'core/freeform'];
        // const MY_TEMPLATE = [
        //     ['core/heading', { placeholder: 'Heading' }],
        //     ['core/query', { "queryId": 0, "query": { "perPage": 3, "pages": 0, "offset": 0, "postType": "post", "categoryIds": [], "tagIds": [], "order": "desc", "orderBy": "date", "author": "", "search": "", "exclude": [], "sticky": "", "inherit": false }, "displayLayout": { "type": "list", "columns": 3 } }],
        //     ['core/paragraph', { placeholder: 'Summary' }],
        //     ['core/button', { className: "is-style-outline" }],
        // ];

        const AFTER = [
            ['core/button', { className: "is-style-outline", text: "View More" }],
        ];

        return (
            <div className={className} {...blockProps}>
                <RichText
                    tagName="h3"
                    onChange={onChangeBeforeContent}
                    value={contentBefore}
                    placeholder="Heading"
                />
                <div>
                    [posts-row-inner]
                </div>
                <div
                    className="preview-content"
                    dangerouslySetInnerHTML={{
                        __html: `<div style="border: firebrick solid">
                                    remote content using js fetch
                                </div>

                                <nav>
                                </nav>

                                <script>
                                    // nav.js
                                </script>
                                `
                    }}
                />
                <InnerBlocks
                    allowedBlocks={ALLOWED_BLOCKS}
                    template={AFTER}
                    // templateLock="all"
                    templateLock={false} // https://developer.wordpress.org/block-editor/reference-guides/block-api/block-templates/
                />
                {/* <RichText
                    tagName="p"
                    onChange={onChangeAfterContent}
                    value={contentAfter}
                    placeholder="content after..."
                /> */}
            </div>
        );
    },
    save: (props) => {
        const blockProps = useBlockProps.save();

        return (
            <div className={props.attributes.className} {...blockProps}>
                {/* <RichText.Content
                    tagName="h3"
                    value={props.attributes.contentBefore}
                /> */}

                [posts-row heading="{props.attributes.contentBefore}" ids=633,540,645]

                {/* <InnerBlocks.Content /> */}

                {/* <RichText.Content
                    tagName="p"
                    value={props.attributes.contentAfter}
                /> */}
            </div>
        );
    },
});