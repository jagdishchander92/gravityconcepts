<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageCraft Builder | Gravity IT Solutions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/pagecraft.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/lib/sweetalert2/dist/sweetalert2.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <input type="hidden" name="" id="hidden_page_id" value="{{ $page_id }}">
    <div class="topbar">
        <div>
            <div class="topbar-logo">PAGE<span>CRAFT</span></div>
            <div class="text-muted" style="font-size: 10px;">By <span
                    style="color: var(--accent);font-weight: bold;">Gravity</span> IT Solutions</div>
        </div>
        <div class="topbar-sep"></div>
        <button class="topbar-btn" onclick="openTemplateModal()"><i class="fa fa-th-large"></i> Templates</button>
        {{-- <button class="topbar-btn" onclick="previewData()"><i class="fa fa-eye"></i> Preview</button> --}}
        <div class="topbar-spacer"></div>
        {{-- <div class="device-btns">
            <button class="device-btn active" onclick="setDevice('desktop',this)"><i class="fa fa-desktop"></i></button>
            <button class="device-btn" onclick="setDevice('tablet',this)"><i
                    class="fa fa-tablet-screen-button"></i></button>
            <button class="device-btn" onclick="setDevice('mobile',this)"><i class="fa fa-mobile-screen"></i></button>
        </div> --}}
        {{-- <div class="topbar-sep"></div> --}}

        <a href="{{ route('pages.edit', $page_id) }}"><button class="topbar-btn"><i class="fa-solid fa-arrow-left"></i>
                Edit Page Info</button></a>
        <button class="topbar-btn" onclick="undoLast()"><i class="fa fa-rotate-left"></i></button>
        <button class="topbar-btn" onclick="previewData()"><i class="fa fa-eye"></i> Preview</button>
        <button class="topbar-btn primary" onclick="saveData()"><i class="fa fa-floppy-disk"></i> Save</button>

        {{-- <button class="topbar-btn primary" onclick="previewData()"><i class="fa fa-floppy-disk"></i> Preview</button> --}}
    </div>

    <div class="main-layout">
        <div class="left-panel">
            <div class="panel-tabs">
                <div class="panel-tab active" onclick="switchTab('elements',this)">Elements</div>
                <div class="panel-tab" onclick="switchTab('templates',this)">Templates</div>
                <div class="panel-tab" onclick="switchTab('cust-templates',this)">Saved</div>
                {{-- <div class="panel-tab" onclick="switchTab('layers',this)">Layers</div> --}}

            </div>
            <div class="panel-content" id="tab-elements">
                <div class="comp-group-label">Structure</div>
                <div class="comp-grid" id="struct-grid"></div>
                <div class="comp-group-label">Content</div>
                <div class="comp-grid" id="content-grid"></div>
                <div class="comp-group-label">Media</div>
                <div class="comp-grid" id="media-grid"></div>
                <div class="comp-group-label">Advanced</div>
                <div class="comp-grid" id="advanced-grid"></div>
            </div>
            <div class="panel-content" id="tab-templates" style="display:none">
                <div class="comp-group-label">Section Templates</div>
                <div id="tpl-list"></div>
            </div>
            <div class="panel-content" id="tab-layers" style="display:none">
                {{-- <div id="layers-tree"></div> --}}
            </div>
            <div class="panel-content" id="tab-cust-templates" style="display:none">
                {{-- <div id="layers-tree"></div> --}}
            </div>
        </div>

        <div class="canvas-wrapper">
            <div class="canvas-area" id="canvas-area">
                <div id="canvas"></div>
                <div class="root-drop-zone" id="root-drop">
                    <i class="fa fa-plus-circle"></i> Drop widget or section here
                    <br>
                    <p class="text-danger">Note: The frontend will display the section based on the theme. The UI shown
                        here is for reference purposes only.</p>
                </div>
                <div class="add-section-root">
                    <button class="add-sec-btn" onclick="addSection()"><i class="fa fa-plus"></i> Add Section</button>
                    <button class="add-sec-btn" onclick="addBsRowSection()"><i class="fa fa-table-columns"></i> BS
                        Row</button>
                    <button class="add-sec-btn" onclick="addDivWrapper()"><i class="fa fa-code"></i> Add Div</button>
                    <button class="add-sec-btn" onclick="openTemplateModal()"><i class="fa fa-layer-group"></i>
                        Template</button>
                </div>
            </div>
        </div>

        <div class="prop-panel">
            <div class="prop-panel-header">
                <i class="fa fa-sliders"></i>
                <span id="propPanelTitle">Properties</span>
                <button onclick="clearPropPanel()"><i class="fa fa-xmark"></i></button>
            </div>
            <div class="prop-panel-body" id="propPanelBody">
                <div class="prop-panel-empty"><i class="fa fa-arrow-pointer"></i>Click any element to edit</div>
            </div>
            <div class="prop-panel-header">
                <i class="fa-solid fa-layer-group"></i>
                <span id="">Layers</span>
                {{-- <button onclick="clearPropPanel()"><i class="fa fa-xmark"></i></button> --}}
            </div>
            <div class="layers-container">
                <div id="layers-tree"></div>
            </div>
        </div>
    </div>

    <!-- TEMPLATE MODAL -->
    <div class="modal-backdrop" id="tplModal" style="display:none"
        onclick="if(event.target===this)closeTplModal()">
        <div class="modal">
            <div class="modal-header">
                <i class="fa fa-layer-group" style="color:var(--accent)"></i>
                <h3>Section Templates</h3>
                <button onclick="closeTplModal()"><i class="fa fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="modal-grid" id="tplModalGrid"></div>
            </div>
        </div>
    </div>
    <div class="fm-modal-backdrop" id="fmModal" style="display:none" onclick="if(event.target===this)closeFM()">
        <div class="fm-modal" onclick="event.stopPropagation()">
            <div class="fm-modal-header">
                <i class="fa fa-images" style="color:var(--accent)"></i>
                <h3>File Manager</h3>
                <button onclick="closeFM()"><i class="fa fa-xmark"></i></button>
            </div>
            <div class="fm-modal-body">
                <div class="fm-upload-zone">
                    <div class="fm-drop-area" id="fmDropArea">
                        <div class="fm-upload-types">
                            <span>JPG</span><span>JPEG</span><span>WEBP</span><span>PNG</span><span>GIF</span>
                        </div>
                        <i class="fa fa-cloud-arrow-up"></i>
                        <p>Drag & drop files here or</p>
                        <button class="browse-btn" onclick="document.getElementById('fmFileInput').click()">Browse
                            Files</button>
                        <input type="file" id="fmFileInput" multiple accept="image/*" style="display:none">
                    </div>
                    <ul class="fm-files-list" id="fmFilesList"></ul>
                </div>
                <div class="fm-gallery">
                    <div class="fm-img-grid" id="fmImgGrid">
                        <div style="grid-column:1/-1;text-align:center;padding:30px;color:var(--text3);font-size:11px">
                            <i class="fa fa-spinner fa-spin"></i> Loading images...
                        </div>
                    </div>
                    <div style="padding:12px 12px 0;display:none" id="fmPagination" class="mt-3">
                        <span style="color:var(--text3);font-size:11px" id="fmPageInfo">Page 1</span>
                        <div class="d-flex gap-2">
                            <button class="topbar-btn" id="fmPrevBtn" onclick="loadImages(currentPage-1,true)"
                                style="opacity:.5"><i class="fa fa-chevron-left"></i> Prev</button>

                            <button class="topbar-btn" id="fmNextBtn" onclick="loadImages(currentPage+1,true)"
                                style="opacity:.5"><i class="fa fa-chevron-right"></i> Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fm-modal-footer">
                <div style="flex:1;display:flex;align-items:center;gap:8px">
                    <input type="text" id="fmUrlInput" placeholder="Or paste image URL directly..."
                        oninput="if(this.value) fmSelectedUrl=this.value.trim(); updateSelectBtn()"
                        style="flex:1;background:var(--surface2);border:1px solid var(--border);color:var(--text);border-radius:5px;padding:5px 8px;font-size:11px;outline:none;font-family:inherit">
                </div>
                <button class="fm-modal-footer btn-cancel" onclick="closeFM()">Cancel</button>
                <button class="fm-modal-footer btn-select" id="fmSelectBtn" onclick="confirmFMSelect()"
                    disabled>Select Image</button>
            </div>
        </div>
    </div>

    <form id="previewForm" method="POST" action="/backend/pagecraft/preview/{{ $page->slug }}" target="_blank"
        style="display:none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="json" id="previewJson">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    <script src="{{ asset('backend/lib/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        // ============================
        // COMPONENT REGISTRY
        // ============================
        const COMPONENTS = {
            struct: [{
                    type: "section",
                    icon: "fa-table-columns",
                    label: "Section",
                },
                {
                    type: "bs-row",
                    icon: "fa-grip",
                    label: "BS Row",
                },
                {
                    type: "div-wrapper",
                    icon: "fa-code",
                    label: "Div Wrapper",
                },
                {
                    type: "spacer",
                    icon: "fa-arrows-up-down",
                    label: "Spacer",
                    props: {
                        height: "50"
                    }
                },
                {
                    type: "shortcode",
                    icon: "fa-code",
                    label: "Shortcode",
                    props: {
                        id: "",
                    },
                },
            ],
            content: [{
                    type: "heading",
                    icon: "fa-heading",
                    label: "Section Heading",
                    props: {
                        text: "Your Heading",
                        sub: "",
                        level: "h2",
                    },
                },
                {
                    type: "text",
                    icon: "fa-align-left",
                    label: "Text",
                    props: {
                        content: "Lorem ipsum dolor sit amet.",
                    },
                },
                {
                    type: "heading-n",
                    icon: "fa-heading",
                    label: "Heading",
                    props: {
                        text: "Your Heading",
                        level: "h2",
                        classes: "",
                    },
                },
                {
                    type: "subheading",
                    icon: "fa-text-height",
                    label: "Subheading",
                    props: {
                        text: "Your subheading text",
                        classes: "",
                    },
                },
                {
                    type: "button",
                    icon: "fa-arrow-pointer",
                    label: "Button",
                    props: {
                        label: "Click Me",
                        href: "#",
                        style: "solid",
                    },
                },
                {
                    type: "list",
                    icon: "fa-list",
                    label: "List",
                    props: {
                        listType: "ul",
                        items: ["Item one", "Item two", "Item three"],
                    },
                },
                {
                    type: "badges",
                    icon: "fa-tags",
                    label: "Badges",
                    props: {
                        items: ["Design", "Development", "Marketing"],
                    },
                },
                {
                    type: "stats",
                    icon: "fa-chart-bar",
                    label: "Stats",
                    props: {
                        items: [{
                                num: "1,000+",
                                label: "Users",
                                icon: "fa fa-users"
                            },
                            {
                                num: "98%",
                                label: "Satisfaction",
                                icon: "fa fa-face-grin-stars"
                            },
                            {
                                num: "50+",
                                label: "Projects",
                                icon: "fa fa-diagram-project"
                            },
                        ],
                    },
                },
                {
                    type: "counter",
                    icon: "fa-hashtag",
                    label: "Counter",
                    props: {
                        num: 100,
                        label: "Projects Done",
                        prefix: "",
                        suffix: "+",
                    },
                },
                {
                    type: "progress",
                    icon: "fa-bars-progress",
                    label: "Progress",
                    props: {
                        bars: [{
                                label: "Design",
                                val: 85,
                            },
                            {
                                label: "Dev",
                                val: 70,
                            },
                        ],
                    },
                },
                {
                    type: "accordion",
                    icon: "fa-chevron-down",
                    label: "Accordion",
                    props: {
                        items: [{
                                q: "What is this?",
                                a: "A great feature.",
                            },
                            {
                                q: "How does it work?",
                                a: "Very easily.",
                            },
                        ],
                    },
                },
                // {
                //     type: "testimonial",
                //     icon: "fa-quote-left",
                //     label: "Testimonial",
                //     props: {
                //         quote: "Amazing!",
                //         author: "John Doe",
                //         role: "CEO",
                //     },
                // },
                {
                    type: "alert",
                    icon: "fa-triangle-exclamation",
                    label: "Alert",
                    props: {
                        text: "This is an alert.",
                        alertType: "info",
                    },
                },
                {
                    type: "divider",
                    icon: "fa-minus",
                    label: "Divider",
                    props: {
                        style: "solid",
                    },
                },
                {
                    type: "icon",
                    icon: "fa-icons",
                    label: "Icon",
                    props: {
                        icon: "star",
                    },
                },
            ],
            media: [{
                    type: "image",
                    icon: "fa-image",
                    label: "Image",
                    props: {
                        src: "https://picsum.photos/seed/pb/600/300",
                        alt: "Image",
                        size: "original",
                    },
                },
                {
                    type: "card-img",
                    icon: "fa-id-card",
                    label: "Image Card",
                    props: {
                        img: "https://picsum.photos/seed/card/400/200",
                        title: "Card Title",
                        desc: "A short description.",
                        btnText: "Read More",
                        btnUrl: "/example"
                    },
                },
                {
                    type: "icon-card",
                    icon: "fa-star",
                    label: "Icon Card",
                    props: {
                        icon: "fa-rocket",
                        title: "Feature",
                        desc: "Brief feature desc.",
                    },
                },
                {
                    type: "video",
                    icon: "fa-play-circle",
                    label: "Video",
                    props: {
                        url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
                    },
                },
            ],
            advanced: [{
                    type: "html",
                    icon: "fa-code",
                    label: "Raw HTML",
                    props: {
                        code: "<p>Custom HTML here</p>",
                    },
                },
                {
                    type: 'process',
                    icon: 'fa-right-long',
                    label: "Process",
                    props: {
                        items: [{
                                icon: "fa-rocket",
                                text: "Fast",
                                desc: "Ship fast.",
                            }, {
                                icon: "fa-shield",
                                text: "Secure",
                                desc: "Always safe.",
                            },
                            {
                                icon: "fa-users",
                                text: "Support",
                                desc: "24/7 help.",
                            },
                            {
                                icon: "fa-chart-line",
                                text: "Growth",
                                desc: "Scale fast.",
                            },
                        ]
                    }
                },
                {
                    type: "theme-section",
                    icon: "fa-layer-group",
                    label: "Theme Block",
                    props: {
                        title: "Why Choose Us",
                        subtitle: "Our Key Features",
                        desc: "We deliver exceptional results.",
                        image: "https://picsum.photos/seed/theme/400/260",
                        btnText: "Get Started",
                        btnUrl: "#",
                        cards: [{
                                icon: "fa-rocket",
                                text: "Fast",
                                desc: "Ship fast.",
                            },
                            {
                                icon: "fa-shield",
                                text: "Secure",
                                desc: "Always safe.",
                            },
                            {
                                icon: "fa-users",
                                text: "Support",
                                desc: "24/7 help.",
                            },
                            {
                                icon: "fa-chart-line",
                                text: "Growth",
                                desc: "Scale fast.",
                            },
                        ],
                    },
                },
                {
                    type: "working-process-section",
                    icon: "fa-stairs",
                    label: "Working Process",
                    props: {
                        title: "We following 3 Easy Steps",
                        subtitle: "Working Process",
                        cards: [{
                                icon: "fa-rocket",
                                text: "Fast",
                                desc: "Ship fast.",
                            },
                            {
                                icon: "fa-shield",
                                text: "Secure",
                                desc: "Always safe.",
                            },
                            {
                                icon: "fa-users",
                                text: "Support",
                                desc: "24/7 help.",
                            },
                        ],
                    },
                },
                {
                    type: "brands-listing",
                    icon: "fa-building",
                    label: "Brands Listing",
                    props: {
                        images: [
                            "https://picsum.photos/seed/brand1/150/50",
                            "https://picsum.photos/seed/brand2/150/50",
                            "https://picsum.photos/seed/brand3/150/50"
                        ],
                    },
                },
            ],
        };
        const ALL_COMPONENTS = [
            ...COMPONENTS.struct,
            ...COMPONENTS.content,
            ...COMPONENTS.media,
            ...COMPONENTS.advanced,
        ];

        const SECTION_TEMPLATES = [{
                id: "hero",
                label: "Hero Section",
                desc: "Full-width hero with heading and button",
                icon: "fa-house",
                build: () => buildHeroTemplate(),
            },
            {
                id: "features",
                label: "3-Column Features",
                desc: "Three icon cards in a row",
                icon: "fa-star",
                build: () => buildFeaturesTemplate(),
            },
            {
                id: "two-col",
                label: "Two Column",
                desc: "Text left, image right",
                icon: "fa-table-columns",
                build: () => buildTwoColTemplate(),
            },
            {
                id: "stats",
                label: "Stats Row",
                desc: "Key numbers in a row",
                icon: "fa-chart-bar",
                build: () => buildStatsTemplate(),
            },
            // {
            //     id: "testimonials",
            //     label: "Testimonials",
            //     desc: "Customer quotes row",
            //     icon: "fa-quote-left",
            //     build: () => buildTestimonialsTemplate(),
            // },
            {
                id: "cta",
                label: "CTA Banner",
                desc: "Call-to-action with button",
                icon: "fa-bullhorn",
                build: () => buildCTATemplate(),
            },
        ];

        // ============================
        // STATE
        // ============================
        let sections = @json($sections ?? []);
        let history = [];
        let dragData = null;
        let activeDragType = null;
        let selectedId = null;
        let selectedType = null;

        const maxAfterFix = fixDuplicateIds(sections);
        let idCounter = Math.max(getMaxId(sections), maxAfterFix) + 1;

        const uid = () => "pb" + idCounter++;

        function getMaxId(data) {
            let max = 1;

            function walk(items) {
                if (!Array.isArray(items)) return;
                items.forEach(item => {
                    if (!item || typeof item !== 'object') return;

                    if (item.id && /^pb\d+$/.test(item.id)) {
                        const num = parseInt(item.id.replace('pb', ''));
                        if (num > max) max = num;
                    }

                    if (item.cols) {
                        item.cols.forEach(col => {
                            if (col.id && /^pb\d+$/.test(col.id)) {
                                const num = parseInt(col.id.replace('pb', ''));
                                if (num > max) max = num;
                            }
                            if (col.widgets) walk(col.widgets);
                        });
                    }

                    if (item.children) walk(item.children);
                });
            }

            walk(data);
            return max;
        }

        function fixDuplicateIds(data) {
            const usedIds = new Set();
            // Start temp counter above max to avoid future collisions
            let tempCounter = getMaxId(data) + 1000;

            function generateId() {
                return 'pb' + tempCounter++;
            }

            function walk(items) {
                if (!Array.isArray(items)) return;
                items.forEach(item => {
                    if (!item || typeof item !== 'object') return;

                    if (!item.id || usedIds.has(item.id)) {
                        item.id = generateId();
                    }
                    usedIds.add(item.id);

                    if (item.cols) {
                        item.cols.forEach(col => {
                            if (!col.id || usedIds.has(col.id)) {
                                col.id = generateId();
                            }
                            usedIds.add(col.id);
                            if (col.widgets) walk(col.widgets);
                        });
                    }

                    if (item.children) walk(item.children);
                });
            }

            walk(data);

            // Return the highest counter used so idCounter can be set safely
            return tempCounter;
        }

        // FM state
        // let fmCallback = null;
        let fmSelectedUrl = null;

        // ============================
        // HISTORY
        // ============================
        let _historyDebounce = null;

        function saveHistory() {
            // Immediately cancel any pending debounced snapshot
            if (_historyDebounce) {
                clearTimeout(_historyDebounce);
                _historyDebounce = null;
            }

            // Schedule snapshot AFTER current mutation completes
            _historyDebounce = setTimeout(() => {
                const snapshot = JSON.stringify(sections);

                // Skip if identical to last saved state
                if (history.length > 0 && history[history.length - 1] === snapshot) {
                    _historyDebounce = null;
                    return;
                }

                history.push(snapshot);

                // Max 10 steps
                if (history.length > 10) history.shift();

                _historyDebounce = null;
            }, 300);
        }

        function undoLast() {
            // Cancel any pending debounced save so undo isn't overwritten
            if (_historyDebounce) {
                clearTimeout(_historyDebounce);
                _historyDebounce = null;
            }

            if (history.length < 2) return;

            history.pop();
            sections = JSON.parse(history[history.length - 1]);

            renderCanvas();
            updateLayers();

            if (selectedId && selectedType) {
                requestAnimationFrame(() => {
                    if (selectedType === 'section') selectSection(selectedId);
                    else if (selectedType === 'widget') selectWidget(selectedId);
                    else if (selectedType === 'div') selectDiv(selectedId);
                });
            }
        }

        // ============================
        // FIND HELPERS
        // ============================

        function findSection(id, list = sections) {
            // Search top-level first
            for (let s of list) {
                if ((s.type === "section" || s.type === "bs-row") && s.id === id)
                    return s;

                // Search in cols
                if (s.cols) {
                    for (let c of s.cols) {
                        for (let w of c.widgets) {
                            if (
                                (w.type === "section" || w.type === "bs-row") &&
                                w.id === id
                            )
                                return w;
                            // Recurse deeper
                            const found = findSection(id, [w]);
                            if (found) return found;
                        }
                    }
                }

                // Search in div children
                if (s.nodeType === "div" && s.children) {
                    const found = findSection(id, s.children);
                    if (found) return found;
                }
            }
            return null;
        }

        function findDivWrapper(id, list = sections) {
            for (let s of list) {
                if (s.id === id && s.nodeType === "div") return s;
                if (s.cols) {
                    for (let c of s.cols) {
                        for (let w of c.widgets) {
                            if (w.nodeType === "div" && w.id === id) return w;
                            if (
                                w.nodeType === "div" ||
                                w.type === "section" ||
                                w.type === "bs-row"
                            ) {
                                const f = findDivWrapper(id, [w]);
                                if (f) return f;
                            }
                        }
                    }
                }
                if (s.children) {
                    for (let ch of s.children) {
                        if (ch.id === id) return ch;
                        const f = findDivWrapper(id, [ch]);
                        if (f) return f;
                    }
                }
            }
            return null;
        }

        function findWidget(widgetId, list = sections) {
            for (let s of list) {
                // Search section columns
                if (s.cols) {
                    for (let c of s.cols) {
                        // Find regular widgets (exclude containers)
                        const w = c.widgets.find(
                            (x) =>
                            x.id === widgetId &&
                            x.type !== "section" &&
                            x.type !== "bs-row" &&
                            x.nodeType !== "div",
                        );
                        if (w)
                            return {
                                widget: w,
                                section: s,
                                col: c,
                                inDiv: false,
                            };

                        // Search inside nested containers
                        for (let w2 of c.widgets) {
                            if (w2.nodeType === "div") {
                                const f = findWidgetInDiv(widgetId, w2);
                                if (f) return f;
                            } else if (w2.type === "section" || w2.type === "bs-row") {
                                const f = findWidget(widgetId, [w2]);
                                if (f) return f;
                            }
                        }
                    }
                }

                // Search div children (top-level)
                if (s.nodeType === "div" && s.children) {
                    const f = findWidgetInDiv(widgetId, s);
                    if (f) return f;
                }
            }
            return null;
        }

        function findWidgetInDiv(widgetId, div) {
            if (!div.children) return null;

            for (let ch of div.children) {
                // Regular widget in div
                if (
                    ch.id === widgetId &&
                    ch.type !== "section" &&
                    ch.type !== "bs-row" &&
                    ch.nodeType !== "div"
                ) {
                    return {
                        widget: ch,
                        divNode: div,
                        inDiv: true,
                    };
                }

                // Recurse into nested divs/sections
                if (ch.nodeType === "div") {
                    const f = findWidgetInDiv(widgetId, ch);
                    if (f) return f;
                } else if (ch.type === "section" || ch.type === "bs-row") {
                    const f = findWidget(widgetId, [ch]);
                    if (f) return f;
                }
            }
            return null;
        }

        function getContainerOf(id, list = sections) {
            for (let s of list) {
                // Check if this container holds the target
                if (s.cols) {
                    for (let c of s.cols) {
                        if (c.widgets.some((w) => w.id === id)) return c.widgets;
                    }
                }
                if (
                    s.nodeType === "div" &&
                    s.children &&
                    s.children.some((ch) => ch.id === id)
                ) {
                    return s.children;
                }

                // Recurse into nested containers
                if (s.cols) {
                    for (let c of s.cols) {
                        for (let w of c.widgets) {
                            if (w.type === "section" || w.type === "bs-row") {
                                const f = getContainerOf(id, [w]);
                                if (f) return f;
                            }
                            if (w.nodeType === "div") {
                                const f = getContainerOf(id, w.children || []);
                                if (f) return f;
                            }
                        }
                    }
                }
                if (s.nodeType === "div" && s.children) {
                    const f = getContainerOf(id, s.children);
                    if (f) return f;
                }
            }
            if (sections.some((s) => s.id === id)) return sections;
            return null;
        }

        function getDivChildContainer(id, div) {
            if (!div.children) return null;
            if (div.children.some((c) => c.id === id)) return div.children;
            for (let ch of div.children) {
                if (ch.nodeType === "div") {
                    const f = getDivChildContainer(id, ch);
                    if (f) return f;
                }
            }
            return null;
        }

        // ============================
        // SECTION OPS
        // ============================
        function addSection(
            parentSectionId = null,
            parentColId = null,
            numCols = 1,
            colWidths = null,
        ) {
            saveHistory();
            const cols = Array(numCols)
                .fill(0)
                .map((_, i) => ({
                    id: uid(),
                    widgets: [],
                    width: colWidths ? colWidths[i] : Math.floor(100 / numCols),
                    flex: {
                        flexDirection: "column",
                        flexWrap: "nowrap",
                        alignItems: "flex-start",
                        justifyContent: "flex-start",
                        gap: "0",
                    },
                }));
            const sec = {
                id: uid(),
                type: "section",
                cols,
                style: {
                    background: "",
                    // padding: "16px 12px",
                    margin: "0",
                    borderRadius: "0",
                    border: "",
                    flexDirection: "row",
                    flexWrap: "wrap",
                    alignItems: "stretch",
                    justifyContent: "flex-start",
                    gap: "0",
                    minHeight: "",
                    bgImage: "",
                    bgSize: "cover",
                    bgPosition: "center",
                    bgRepeat: "no-repeat",
                    pt: "",
                    pr: "",
                    pb: "",
                    pl: "",
                    mt: "",
                    mr: "",
                    mb: "",
                    ml: "",
                    classes: "",
                },
            };
            if (parentSectionId && parentColId) {
                const ps = findSection(parentSectionId);
                const pc = ps.cols.find((c) => c.id === parentColId);
                pc.widgets.push(sec);
            } else sections.push(sec);
            renderCanvas();
            updateLayers();
            selectSection(sec.id);
            return sec;
        }

        // Bootstrap Row Section
        function addBsRowSection(parentSectionId = null, parentColId = null) {
            saveHistory();
            const cols = [{
                    id: uid(),
                    widgets: [],
                    bsCol: "col-md-6",
                    flex: {
                        flexDirection: "column",
                        alignItems: "flex-start",
                        justifyContent: "flex-start",
                        gap: "0",
                    },
                },
                {
                    id: uid(),
                    widgets: [],
                    bsCol: "col-md-6",
                    flex: {
                        flexDirection: "column",
                        alignItems: "flex-start",
                        justifyContent: "flex-start",
                        gap: "0",
                    },
                },
            ];
            const sec = {
                id: uid(),
                type: "bs-row",
                cols,
                style: {
                    background: "",
                    // padding: "16px 12px",
                    margin: "0",
                    borderRadius: "0",
                    border: "",
                    minHeight: "",
                    bgImage: "",
                    bgSize: "cover",
                    bgPosition: "center",
                    bgRepeat: "no-repeat",
                    pt: "",
                    pr: "",
                    pb: "",
                    pl: "",
                    mt: "",
                    mr: "",
                    mb: "",
                    ml: "",
                    classes: "",
                },
            };
            if (parentSectionId && parentColId) {
                const ps = findSection(parentSectionId);
                const pc = ps.cols.find((c) => c.id === parentColId);
                pc.widgets.push(sec);
            } else sections.push(sec);
            renderCanvas();
            updateLayers();
            selectSection(sec.id);
            return sec;
        }

        // Div Wrapper — no auto content, just classes+styles
        function addDivWrapper(
            parentSectionId = null,
            parentColId = null,
            parentDivId = null,
        ) {
            saveHistory();
            const div = {
                id: uid(),
                nodeType: "div",
                children: [],
                divClasses: "",
                divStyle: "",
                inlineStyles: {
                    background: "",
                    padding: "",
                    margin: "",
                    border: "",
                    borderRadius: "",
                    display: "",
                    flexDirection: "",
                    alignItems: "",
                    justifyContent: "",
                    gap: "",
                    width: "",
                    height: "",
                    color: "",
                    fontSize: "",
                    fontWeight: "",
                    textAlign: "",
                    bgImage: "",
                    bgSize: "cover",
                    bgPosition: "center",
                    bgRepeat: "no-repeat",
                    pt: "",
                    pr: "",
                    pb: "",
                    pl: "",
                    mt: "",
                    mr: "",
                    mb: "",
                    ml: "",
                },
            };
            if (parentDivId) {
                const parentDiv = findDivWrapper(parentDivId);
                if (parentDiv) {
                    parentDiv.children.push(div);
                    renderCanvas();
                    updateLayers();
                    selectDiv(div.id);
                    return div;
                }
            }
            if (parentSectionId && parentColId) {
                const ps = findSection(parentSectionId);
                const pc = ps.cols.find((c) => c.id === parentColId);
                pc.widgets.push(div);
            } else {
                // add as top-level in last section col or create section
                if (sections.length === 0) {
                    const s = addSection();
                    s.cols[0].widgets.push(div);
                } else {
                    sections[sections.length - 1].cols[0].widgets.push(div);
                }
            }
            renderCanvas();
            updateLayers();
            selectDiv(div.id);
            return div;
        }

        function removeSection(id) {
            saveHistory();
            const container = getContainerOf(id);
            if (container) {
                const idx = container.findIndex((x) => x.id === id);
                if (idx >= 0) container.splice(idx, 1);
            }
            if (selectedId === id) {
                selectedId = null;
                selectedType = null;
                clearPropPanel();
            }
            renderCanvas();
            updateLayers();
        }

        function duplicateSection(id) {
            saveHistory();
            const original = findSection(id);
            const clone = JSON.parse(JSON.stringify(original));
            assignNewIds(clone); // reassign all ids
            sanitizeDuplicateIds([clone]); // catch any remaining duplicates
            const container = getContainerOf(id);
            if (container) {
                const idx = container.findIndex((x) => x.id === id);
                container.splice(idx + 1, 0, clone);
            }
            renderCanvas();
            updateLayers();
        }

        function assignNewIds(node) {
            if (!node || typeof node !== "object") return;

            // assign new id if exists
            if (node.id) {
                node.id = uid();
            }

            // cols
            if (Array.isArray(node.cols)) {
                node.cols.forEach((col) => {
                    if (col.id) col.id = uid();

                    if (Array.isArray(col.widgets)) {
                        col.widgets.forEach(assignNewIds);
                    }
                });
            }

            // children
            if (Array.isArray(node.children)) {
                node.children.forEach(assignNewIds);
            }

            // generic recursive fallback
            Object.values(node).forEach((val) => {
                if (Array.isArray(val)) {
                    val.forEach(assignNewIds);
                } else if (val && typeof val === "object") {
                    assignNewIds(val);
                }
            });
        }

        function sanitizeDuplicateIds(list = sections) {
            const seen = new Set();

            function walk(node) {
                if (!node || typeof node !== 'object') return;

                // Fix duplicate id
                if (node.id) {
                    if (seen.has(node.id)) {
                        node.id = uid(); // assign fresh id
                    } else {
                        seen.add(node.id);
                    }
                }

                // Walk cols
                if (node.cols) {
                    node.cols.forEach((col) => {
                        if (col.id) {
                            if (seen.has(col.id)) {
                                col.id = uid();
                            } else {
                                seen.add(col.id);
                            }
                        }
                        if (col.widgets) col.widgets.forEach(walk);
                    });
                }

                // Walk div children
                if (node.children) {
                    node.children.forEach(walk);
                }
            }

            list.forEach(walk);
        }

        function moveSectionDir(id, dir) {
            saveHistory();
            const container = getContainerOf(id);
            if (!container) return;
            const idx = container.findIndex((x) => x.id === id);
            const swapIdx = idx + dir;
            if (swapIdx < 0 || swapIdx >= container.length) return;
            [container[idx], container[swapIdx]] = [container[swapIdx], container[idx]];
            renderCanvas();
            updateLayers();
        }

        // ============================
        // WIDGET OPS
        // ============================
        function addWidget(sectionId, colId, type, props, divId = null) {
            saveHistory();
            const comp = ALL_COMPONENTS.find((c) => c.type === type);
            const w = {
                id: uid(),
                type,
                props: props || JSON.parse(JSON.stringify(comp ? comp.props : {})),
                style: {
                    background: "",
                    padding: "",
                    margin: "",
                    border: "",
                    borderRadius: "",
                    color: "",
                    fontSize: "",
                    fontWeight: "",
                    textAlign: "",
                    opacity: "",
                    boxShadow: "",
                    bgImage: "",
                    bgSize: "cover",
                    bgPosition: "center",
                    bgRepeat: "no-repeat",
                    pt: "",
                    pr: "",
                    pb: "",
                    pl: "",
                    mt: "",
                    mr: "",
                    mb: "",
                    ml: "",
                    classes: "",
                },
            };
            if (divId) {
                const div = findDivWrapper(divId);
                if (div) {
                    div.children.push(w);
                    renderCanvas();
                    updateLayers();
                    return w;
                }
            }
            const sec = findSection(sectionId);
            const col = sec.cols.find((c) => c.id === colId);
            col.widgets.push(w);
            renderCanvas();
            updateLayers();
            return w;
        }

        function removeWidget(widgetId) {
            saveHistory();
            // Try section widgets
            const found = findWidget(widgetId);
            if (found) {
                if (found.inDiv) {
                    found.divNode.children = found.divNode.children.filter(
                        (c) => c.id !== widgetId,
                    );
                } else {
                    found.col.widgets = found.col.widgets.filter(
                        (w) => w.id !== widgetId,
                    );
                }
            }
            if (selectedId === widgetId) {
                selectedId = null;
                selectedType = null;
                clearPropPanel();
            }
            renderCanvas();
            updateLayers();
        }

        function duplicateWidget(widgetId) {
            saveHistory();

            const found = findWidget(widgetId);
            if (!found) return;

            const clone = JSON.parse(JSON.stringify(found.widget));

            // FIX: regenerate all nested ids
            assignNewIds(clone);
            sanitizeDuplicateIds([clone]);

            if (found.inDiv) {
                const idx = found.divNode.children.findIndex(
                    (c) => c.id === widgetId
                );

                found.divNode.children.splice(idx + 1, 0, clone);
            } else {
                const idx = found.col.widgets.findIndex(
                    (w) => w.id === widgetId
                );

                found.col.widgets.splice(idx + 1, 0, clone);
            }

            renderCanvas();
            updateLayers();
        }

        function moveWidgetDir(widgetId, dir) {
            saveHistory();
            const found = findWidget(widgetId);
            if (!found) return;
            const ws = found.inDiv ? found.divNode.children : found.col.widgets;
            const idx = ws.findIndex((w) => w.id === widgetId);
            const swap = idx + dir;
            if (swap < 0 || swap >= ws.length) return;
            [ws[idx], ws[swap]] = [ws[swap], ws[idx]];
            renderCanvas();
            updateLayers();
        }

        function removeDiv(divId) {
            saveHistory();
            const container =
                getContainerOf(divId) ||
                getDivChildContainer(divId, {
                    children: sections.flatMap((s) =>
                        s.cols ? s.cols.flatMap((c) => c.widgets) : s.children || [],
                    ),
                });
            // fallback: search everywhere
            function removeFromList(list) {
                const idx = list.findIndex((x) => x.id === divId);
                if (idx >= 0) {
                    list.splice(idx, 1);
                    return true;
                }
                for (let item of list) {
                    if (item.children && removeFromList(item.children)) return true;
                    if (item.cols) {
                        for (let col of item.cols) {
                            if (removeFromList(col.widgets)) return true;
                        }
                    }
                }
                return false;
            }
            removeFromList(sections);
            if (selectedId === divId) {
                selectedId = null;
                selectedType = null;
                clearPropPanel();
            }
            renderCanvas();
            updateLayers();
        }

        // ============================
        // RENDER WIDGET CONTENT
        // ============================
        function renderWidgetContent(widget) {
            const p = widget.props || {};
            switch (widget.type) {
                case "heading":
                    return `<div class="w-heading"><${p.level || "h2"} style="margin:0">${p.text || "Heading"}</${p.level || "h2"}>${p.sub ? `<p style="margin:4px 0 0">${p.sub}</p>` : ""}</div>`;
                case "heading-n":
                    return `<${p.level || "h2"} class="${p.classes || ""}" style="margin:0">${p.text || "Heading"}</${p.level || "h2"}>`;
                case "subheading":
                    return `<p class="${p.classes || ""}" style="margin:4px 0 0 0">${p.text || "Subheading"}</p>`;
                case "text":
                    return `<div class="w-text"><p>${(p.content || "").replace(/\n/g, "<br>")}</p></div>`;
                case "button":
                    return `<div class="w-btn"><a href="${p.href || "#"}" class="${p.style === "outline" ? "outline" : ""}" onclick="return false">${p.label || "Button"}</a></div>`;
                case "image":
                    return `<div class="w-image"><img src="${p.src || ""}" alt="${p.alt || ""}"></div>`;
                case "card-img":
                    return `<div class="w-card-img"><img src="${p.img || ""}" alt="${p.title || ""}"><div class="cinfo"><h4>${p.title || ""}</h4><p>${p.desc || ""}</p><button class="btn btn-primary">${p.btnText }</button></div></div>`;
                case "icon-card":
                    return `<div class="w-icon-card"><div class="ic-circle"><i class="fa ${p.icon || "fa-star"}"></i></div><h4>${p.title || "Title"}</h4><p>${p.desc || ""}</p></div>`;
                case "icon":
                    return `<div class="w-icon" style="padding:6px"><i class="fa fa-${p.icon || "star"}" style="font-size:22px;color:var(--accent)"></i></div>`;
                case "divider":
                    return `<div class="w-divider"><hr class="${p.style || "solid"}"></div>`;
                case "badges":
                    return `<div class="w-badge-list">${(p.items || []).map((t) => `<span>${t}</span>`).join("")}</div>`;
                case "stats":
                    return `<div class="w-stats">${(p.items || []).map((s) => `<div class="stat"><div class="icon"><i class="${s.icon}"></i></div><div class="num">${s.num}</div><div class="lbl">${s.label}</div></div>`).join("")}</div>`;
                case "counter":
                    return `<div class="w-counter"><div class="counter-num">${p.prefix || ""}${p.num || 0}${p.suffix || ""}</div><div class="counter-label">${p.label || ""}</div></div>`;
                case "progress":
                    return `<div class="w-progress">${(p.bars || []).map((b) => `<div class="prog-item"><div class="prog-label"><span>${b.label}</span><span>${b.val}%</span></div><div class="prog-bar"><div class="prog-fill" style="width:${b.val}%"></div></div></div>`).join("")}</div>`;
                case "accordion":
                    return `<div class="w-accordion">${(p.items || []).map((it, i) => `<div class="acc-item" id="acci-${widget.id}-${i}"><div class="acc-q" onclick="toggleAcc('${widget.id}',${i})">${it.q}<i class="fa fa-chevron-down" style="font-size:10px"></i></div><div class="acc-a">${it.a}</div></div>`).join("")}</div>`;
                case "testimonial":
                    return `<div class="w-testimonial"><div class="quote">"${p.quote || ""}"</div><div class="author">${p.author || ""}</div><div class="role">${p.role || ""}</div></div>`;
                case "alert":
                    return `<div class="w-alert ${p.alertType || "info"}"><i class="fa fa-circle-info"></i><span>${p.text || ""}</span></div>`;
                case "list":
                    return `<div class="w-list"><${p.listType || "ul"}>${(p.items || []).map((i) => `<li>${i}</li>`).join("")}</${p.listType || "ul"}></div>`;
                case "video":
                    return `<div class="w-video"><iframe src="${p.url || ""}" allowfullscreen></iframe></div>`;
                case "html":
                    return `<div class="w-html">${p.code || ""}</div>`;
                case "spacer": {
                    const h = p.height || 40;
                    return `<div class="w-spacer" style="height:${h}px"><span>${h}px spacer</span></div>`;
                }
                case "theme-section":
                    return renderThemeSection(p);
                case "process":
                    return renderProcessSection(p);
                case "working-process-section":
                    return renderWorkingProcessSection(p);
                case "shortcode":
                    return `<div class="w-shortcode">
                        <div class="shortcode-badge">${p.id ? '[ID: ' + p.id + ']' : '[No ID]'}</div>
                        <div class="shortcode-content">Enter Your Shortcode content here</div>
                    </div>`;
                case "brands-listing":
                    const brandImages = (p.images || []).map(img =>
                        `<div class="brand-logo-item"><img src="${img}" alt="Brand"></div>`
                    ).join("");
                    return `<div class="w-brands-listing">${brandImages}</div>`;
                default:
                    return `<div style="color:var(--text3);padding:14px;text-align:center;border:1px dashed var(--border);border-radius:5px;font-size:11px">Unknown: ${widget.type}</div>`;
            }
        }

        function renderThemeSection(p) {
            const cards = (p.cards || [])
                .map(
                    (c) =>
                    `<div class="ts-card"><div class="tc-icon"><i class="fa ${c.icon || "fa-star"}"></i></div><h4>${c.text || ""}</h4><p>${c.desc || ""}</p></div>`,
                )
                .join("");
            return `<div class="w-theme-section"><div class="ts-hero"><div class="ts-hero-text"><h3>${p.subtitle || ""}</h3><h2>${p.title || ""}</h2><p>${p.desc || ""}</p><a href="${p.btnUrl || "#"}" class="ts-btn" onclick="return false"><i class="fa fa-arrow-right"></i>${p.btnText || "Learn More"}</a></div>${p.image ? `<div class="ts-hero-img"><img src="${p.image}" alt=""></div>` : ""}</div><div class="ts-cards">${cards}</div></div>`;
        }

        function renderProcessSection(p) {
            const cards = (p.items || [])
                .map(
                    (c) =>
                    `<div class="ts-card"><div class="tc-icon"><i class="fa ${c.icon || "fa-star"}"></i></div><h4>${c.text || ""}</h4><p>${c.desc || ""}</p></div>`,
                )
                .join("");
            return `<div class="w-process"><div class="ts-cards">${cards}</div></div>`;
        }

        function renderWorkingProcessSection(p) {
            const cards = (p.cards || [])
                .map(
                    (c) =>
                    `<div class="ts-card"><div class="tc-icon"><i class="fa ${c.icon || "fa-star"}"></i></div><h4>${c.text || ""}</h4><p>${c.desc || ""}</p></div>`,
                )
                .join("");
            return `<div class="w-working-process-section"><div class="ts-hero"><div class="ts-hero-text"><h3>${p.subtitle || ""}</h3><h2>${p.title || ""}</h2></div></div><div class="ts-cards">${cards}</div></div>`;
        }

        function renderBrandsListingSection(p) {
            const images = (p.images || [])
                .map(
                    (c) =>
                    `<div class="ts-card"><img src="${c}"/></div>`,
                )
                .join("");
            return images;
        }

        function toggleAcc(wid, idx) {
            const el = document.getElementById(`acci-${wid}-${idx}`);
            if (el) el.classList.toggle("open");
        }

        // ============================
        // BUILD ELEMENTS
        // ============================
        function applyNodeStyle(el, sty) {
            if (!sty) return;
            // composed margin/padding from 4-dir or shorthand
            const pad = buildSpacing(sty.pt, sty.pr, sty.pb, sty.pl, sty.padding);
            const mar = buildSpacing(sty.mt, sty.mr, sty.mb, sty.ml, sty.margin);
            if (pad) el.style.padding = pad;
            if (mar) el.style.margin = mar;
            if (sty.background) el.style.background = sty.background;
            if (sty.border) el.style.border = sty.border;
            if (sty.borderRadius) el.style.borderRadius = sty.borderRadius;
            if (sty.minHeight) el.style.minHeight = sty.minHeight;
            if (sty.bgImage) {
                el.style.backgroundImage = `url('${sty.bgImage}')`;
                el.style.backgroundSize = sty.bgSize || "cover";
                el.style.backgroundPosition = sty.bgPosition || "center";
                el.style.backgroundRepeat = sty.bgRepeat || "no-repeat";
            }
            if (sty.boxShadow) el.style.boxShadow = sty.boxShadow;
            if (sty.opacity) el.style.opacity = sty.opacity;
            if (sty.color) el.style.color = sty.color;
            if (sty.fontSize) el.style.fontSize = sty.fontSize;
            if (sty.fontWeight) el.style.fontWeight = sty.fontWeight;
            if (sty.textAlign) el.style.textAlign = sty.textAlign;
        }

        function buildSpacing(t, r, b, l, shorthand) {
            if (t || r || b || l) {
                return `${t || "0"} ${r || "0"} ${b || "0"} ${l || "0"}`;
            }
            return shorthand || "";
        }

        function buildWidgetEl(widget, section, col, divNode = null) {
            // CHECK IF THIS IS ACTUALLY A SECTION/ROW/DIV - DON'T TREAT AS WIDGET
            if (widget.type === "section" || widget.type === "bs-row") {
                return buildSectionEl(widget, true);
            }
            if (widget.nodeType === "div") {
                return buildDivEl(widget, true);
            }

            // Regular widget logic
            const div = document.createElement("div");
            // div.className = "pb-widget no-select";
            // div.id = widget.id;

            div.className = "pb-widget no-select sortable-item";
            div.id = widget.id;
            div.draggable = true;
            applyNodeStyle(div, widget.style);
            if (widget.style && widget.style.classes)
                div.className += " " + widget.style.classes;

            const comp = ALL_COMPONENTS.find((c) => c.type === widget.type);
            const icon = comp ? comp.icon : "fa-puzzle-piece";
            const label = comp ? comp.label : "Widget";

            div.innerHTML = `
        <div class="widget-toolbar">
            <span class="wtlabel"><i class="fa ${icon}"></i>${label}</span>
            <button onclick="event.stopPropagation();moveWidgetDir('${widget.id}',-1)" title="Up"><i class="fa fa-chevron-up"></i></button>
            <button onclick="event.stopPropagation();moveWidgetDir('${widget.id}',1)" title="Down"><i class="fa fa-chevron-down"></i></button>
            <button onclick="event.stopPropagation();duplicateWidget('${widget.id}')" title="Duplicate"><i class="fa fa-copy"></i></button>
            <button onclick="event.stopPropagation();removeWidget('${widget.id}')" title="Delete"><i class="fa fa-trash"></i></button>
        </div>
        <div class="widget-body">${renderWidgetContent(widget)}</div>`;

            div.addEventListener("dragstart", (e) => {
                dragData = {
                    type: "widget",
                    widgetId: widget.id,
                };
                div.classList.add("dragging");
                e.stopPropagation();
            });
            div.addEventListener("dragend", () => {
                dragData = null;
                div.classList.remove("dragging");
            });
            div.addEventListener("click", (e) => {
                e.stopPropagation();
                selectWidget(widget.id);
            });
            return div;
        }

        function buildDivEl(divNode, isNested = false) {
            const el = document.createElement("div");
            el.className = `pb-div-wrapper sortable-item${isNested ? " nested-div" : ""}`;
            el.id = divNode.id;
            if (isNested) {
                el.style.width = "100%";
                el.style.boxSizing = "border-box";
            }
            // apply inline styles
            const s = divNode.inlineStyles || {};
            applyNodeStyle(el, s);
            if (divNode.divStyle) {
                // parse inline style string
                try {
                    const tmp = document.createElement("div");
                    tmp.style.cssText = divNode.divStyle;
                    Array.from(tmp.style).forEach((k) => {
                        if (!el.style[k]) el.style[k] = tmp.style[k];
                    });
                } catch (e) {}
            }
            const toolbar = document.createElement("div");
            toolbar.className = "div-toolbar";
            const classPreview = divNode.divClasses ?
                `<span style="font-size:9px;opacity:.7;margin-left:4px;font-weight:400">.${divNode.divClasses.split(" ").join(" .")}</span>` :
                "";
            toolbar.innerHTML =
                `
<span class="div-label"><i class="fa fa-code"></i>&lt;div&gt;${classPreview}</span>
<button onclick="event.stopPropagation();moveSectionDir('${divNode.id}',-1)"><i class="fa fa-chevron-up"></i></button>
<button onclick="event.stopPropagation();moveSectionDir('${divNode.id}',1)"><i class="fa fa-chevron-down"></i></button>
<button onclick="event.stopPropagation();saveTemplate('${divNode.id}')"><i class="fa fa-bookmark"></i></button>
<button onclick="event.stopPropagation();selectDiv('${divNode.id}')" title="Settings"><i class="fa fa-sliders"></i></button>
<button onclick="event.stopPropagation();duplicateDiv('${divNode.id}')" title="Duplicate"><i class="fa fa-copy"></i></button>
<button onclick="event.stopPropagation();addDivWrapper(null,null,'${divNode.id}')" title="Add Nested Div"><i class="fa fa-plus"></i>&lt;div&gt;</button>
<button onclick="event.stopPropagation();removeDiv('${divNode.id}')" title="Delete"><i class="fa fa-trash"></i></button>`;
            const inner = document.createElement("div");
            inner.className = "div-inner";
            inner.id = "div-inner-" + divNode.id;
            if (divNode.children && divNode.children.length === 0) {
                const hint = document.createElement("div");
                hint.className = "div-drop-zone";
                hint.textContent = "Drop elements into this div";
                inner.appendChild(hint);
            } else {
                // In buildDivEl(), REPLACE the children loop:
                (divNode.children || []).forEach((ch) => {
                    if (ch.type === "section" || ch.type === "bs-row") {
                        inner.appendChild(buildSectionEl(ch, true));
                    } else if (ch.nodeType === "div") {
                        inner.appendChild(buildDivEl(ch, true));
                    } else {
                        // ✅ Regular widgets only
                        inner.appendChild(buildWidgetEl(ch, null, null, divNode));
                    }
                });
            }
            inner.addEventListener("dragover", (e) => {
                e.preventDefault();
                e.stopPropagation();
                inner.classList.add("drag-over");
            });
            inner.addEventListener("dragleave", (e) => {
                if (!inner.contains(e.relatedTarget))
                    inner.classList.remove("drag-over");
            });
            inner.addEventListener("drop", (e) => {
                e.preventDefault();
                e.stopPropagation();
                inner.classList.remove("drag-over");
                handleDivDrop(divNode.id);
            });
            el.appendChild(toolbar);
            el.appendChild(inner);
            el.addEventListener("click", (e) => {
                e.stopPropagation();
                selectDiv(divNode.id);
            });
            return el;
        }

        function duplicateDiv(divId) {
            saveHistory();
            const original = findDivWrapper(divId);
            if (!original) return;

            const clone = JSON.parse(JSON.stringify(original));
            assignNewIds(clone); // reassign all ids
            sanitizeDuplicateIds([clone]); // catch any remaining duplicates

            function insertAfterInList(list) {
                const idx = list.findIndex(x => x.id === divId);
                if (idx >= 0) {
                    list.splice(idx + 1, 0, clone);
                    return true;
                }
                for (let item of list) {
                    if (item.children && item.children.length) {
                        if (insertAfterInList(item.children)) return true;
                    }
                    if (item.cols) {
                        for (let col of item.cols) {
                            if (insertAfterInList(col.widgets)) return true;
                        }
                    }
                }
                return false;
            }

            insertAfterInList(sections);
            renderCanvas();
            updateLayers();
        }


        function buildSectionEl(section, isNested = false) {
            const div = document.createElement("div");
            div.className = `pb-section sortable-item${isNested ? " nested" : ""}`;
            div.id = section.id;
            if (isNested) {
                div.style.width = "100%";
                div.style.flex = "1 1 100%";
                div.style.minWidth = "0";
            }
            const sty = section.style || {};
            applyNodeStyle(div, sty);
            if (sty.classes) div.className += " " + sty.classes;

            const isBsRow = section.type === "bs-row";
            const toolbar = document.createElement("div");
            toolbar.className = "section-toolbar";
            toolbar.innerHTML =
                `
<span class="section-label"><i class="fa ${isBsRow ? "fa-grip" : "fa-table-columns"}"></i>${isNested ? "Inner " : ""} ${isBsRow ? "BS Row" : "Section"} (${section.cols.length} col${section.cols.length > 1 ? "s" : ""})</span>
<button onclick="event.stopPropagation();moveSectionDir('${section.id}',-1)"><i class="fa fa-chevron-up"></i></button>
<button onclick="event.stopPropagation();moveSectionDir('${section.id}',1)"><i class="fa fa-chevron-down"></i></button>
<button onclick="event.stopPropagation();saveTemplate('${section.id}')"><i class="fa fa-bookmark"></i></button>
<button onclick="event.stopPropagation();selectSection('${section.id}')"><i class="fa fa-sliders"></i></button>
<button onclick="event.stopPropagation();duplicateSection('${section.id}')"><i class="fa fa-copy"></i></button>
<button class="danger" onclick="event.stopPropagation();removeSection('${section.id}')"><i class="fa fa-trash"></i></button>`;

            const body = document.createElement("div");
            body.className = "section-body";
            const colsRow = document.createElement("div");

            if (isBsRow) {
                colsRow.className = "row";
                colsRow.style.margin = "0";
            } else {
                colsRow.className = "section-cols-row";
                if (sty.flexDirection) colsRow.style.flexDirection = sty.flexDirection;
                if (sty.flexWrap) colsRow.style.flexWrap = sty.flexWrap;
                if (sty.alignItems) colsRow.style.alignItems = sty.alignItems;
                if (sty.justifyContent)
                    colsRow.style.justifyContent = sty.justifyContent;
                if (sty.gap) colsRow.style.gap = sty.gap;
            }

            section.cols.forEach((col) => {
                const colEl = document.createElement("div");
                colEl.id = col.id;
                if (isBsRow) {
                    colEl.className = (col.bsCol || "col-md-6") + " pb-bs-col";
                    colEl.style.border = "1px dashed var(--border)";
                    colEl.style.borderRadius = "4px";
                    colEl.style.padding = "5px";
                    colEl.style.minHeight = "50px";
                } else {
                    colEl.className = "section-col";
                    const w = col.width || Math.floor(100 / section.cols.length);
                    colEl.style.flex = `0 0 calc(${w}% - 3px)`;
                    colEl.style.width = `calc(${w}% - 3px)`;
                    colEl.style.minWidth = "0";
                    colEl.style.overflow = "hidden";
                    if (col.flex) {
                        const cf = col.flex;
                        colEl.style.display = "flex";
                        colEl.style.flexDirection = cf.flexDirection || "column";
                        colEl.style.flexWrap = cf.flexWrap || "wrap";
                        colEl.style.alignItems = cf.alignItems || "flex-start";
                        colEl.style.justifyContent = cf.justifyContent || "flex-start";
                        if (cf.gap) colEl.style.gap = cf.gap;
                    }
                }
                const handle = document.createElement("div");
                handle.className = "col-handle";
                handle.innerHTML = isBsRow ?
                    `<span class="col-width-badge">${col.bsCol || "col-md-6"}</span>` :
                    `<span class="col-width-badge">${col.width || Math.floor(100 / section.cols.length)}%</span>`;
                colEl.appendChild(handle);

                if (col.widgets.length === 0) {
                    const hint = document.createElement("div");
                    hint.className = "col-empty-hint";
                    hint.textContent = "Drop here";
                    colEl.appendChild(hint);
                } else {
                    // In buildSectionEl(), REPLACE the col widgets loop:
                    col.widgets.forEach((widget) => {
                        if (widget.type === "section" || widget.type === "bs-row") {
                            colEl.appendChild(buildSectionEl(widget, true));
                        } else if (widget.nodeType === "div") {
                            colEl.appendChild(buildDivEl(widget, true));
                        } else {
                            // ✅ Regular widgets only
                            colEl.appendChild(buildWidgetEl(widget, section, col));
                        }
                    });
                }
                colEl.addEventListener("dragover", (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    colEl.classList.add("drag-over");
                });
                colEl.addEventListener("dragleave", (e) => {
                    if (!colEl.contains(e.relatedTarget))
                        colEl.classList.remove("drag-over");
                });
                colEl.addEventListener("drop", (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    colEl.classList.remove("drag-over");
                    handleColDrop(section.id, col.id);
                });
                colsRow.appendChild(colEl);
            });

            body.appendChild(colsRow);
            div.appendChild(toolbar);
            div.appendChild(body);
            div.addEventListener("click", (e) => {
                e.stopPropagation();
                selectSection(section.id);
            });
            div.addEventListener("dragover", (e) => {
                e.preventDefault();
                div.classList.add("drag-over-section");
            });
            div.addEventListener("dragleave", (e) => {
                if (!div.contains(e.relatedTarget))
                    div.classList.remove("drag-over-section");
            });
            div.addEventListener("drop", (e) => {
                e.preventDefault();
                e.stopPropagation();
                div.classList.remove("drag-over-section");
            });
            return div;
        }

        function handleColDrop(sectionId, colId) {
            if (activeDragType) {
                if (activeDragType === "section") addSection(sectionId, colId);
                else if (activeDragType === "bs-row") addBsRowSection(sectionId, colId);
                else if (activeDragType === "div-wrapper") addDivWrapper(sectionId, colId);
                else if (activeDragType === "__template__") {
                    // Find the target col's widget list and insert there
                    const sec = findSection(sectionId);
                    const col = sec ? sec.cols.find(c => c.id === colId) : null;
                    applyPendingTemplate(col ? col.widgets : null);
                } else if (dragData && dragData.type === "widget") {
                    const found = findWidget(dragData.widgetId);
                    if (!found) return;
                    const sec = findSection(sectionId);
                    const col = sec.cols.find((c) => c.id === colId);
                    if (found.col && found.col.id === colId) return;
                    const srcList = found.inDiv ?
                        found.divNode.children :
                        found.col.widgets;
                    const idx = srcList.findIndex((w) => w.id === dragData.widgetId);
                    const w = srcList.splice(idx, 1)[0];
                    col.widgets.push(w);
                    saveHistory();
                    renderCanvas();
                    updateLayers();
                    dragData = null;
                } else addWidget(sectionId, colId, activeDragType);
                activeDragType = null;

            }
        }

        // function handleDivDrop(divId) {
        //     if (activeDragType) {
        //         // Panel drag (section, bs-row, div-wrapper, or widget)
        //         if (activeDragType === "div-wrapper") {
        //             addDivWrapper(null, null, divId);
        //         } else if (activeDragType === "section") {
        //             // Add section inside div
        //             saveHistory();
        //             const divNode = findDivWrapper(divId);
        //             if (divNode) {
        //                 const sec = {
        //                     id: uid(),
        //                     type: "section",
        //                     cols: [{
        //                         id: uid(),
        //                         widgets: [],
        //                         width: 100,
        //                         flex: {
        //                             flexDirection: "column",
        //                             flexWrap: "nowrap",
        //                             alignItems: "flex-start",
        //                             justifyContent: "flex-start",
        //                             gap: "0",
        //                         },
        //                     }, ],
        //                     style: {
        //                         background: "",
        //                         padding: "16px 12px",
        //                         margin: "0",
        //                         borderRadius: "0",
        //                         border: "",
        //                         flexDirection: "row",
        //                         flexWrap: "wrap",
        //                         alignItems: "stretch",
        //                         justifyContent: "flex-start",
        //                         gap: "0",
        //                         minHeight: "",
        //                         bgImage: "",
        //                         bgSize: "cover",
        //                         bgPosition: "center",
        //                         bgRepeat: "no-repeat",
        //                         pt: "",
        //                         pr: "",
        //                         pb: "",
        //                         pl: "",
        //                         mt: "",
        //                         mr: "",
        //                         mb: "",
        //                         ml: "",
        //                         classes: "",
        //                     },
        //                 };
        //                 divNode.children.push(sec);
        //                 renderCanvas();
        //                 updateLayers();
        //             }
        //         } else if (activeDragType === "bs-row") {
        //             // Add BS row inside div
        //             saveHistory();
        //             const divNode = findDivWrapper(divId);
        //             if (divNode) {
        //                 const sec = {
        //                     id: uid(),
        //                     type: "bs-row",
        //                     cols: [{
        //                         id: uid(),
        //                         widgets: [],
        //                         bsCol: "col-md-12",
        //                         flex: {
        //                             flexDirection: "column",
        //                             alignItems: "flex-start",
        //                             justifyContent: "flex-start",
        //                             gap: "0",
        //                         },
        //                     }, ],
        //                     style: {
        //                         background: "",
        //                         padding: "16px 12px",
        //                         margin: "0",
        //                         borderRadius: "0",
        //                         border: "",
        //                         minHeight: "",
        //                         bgImage: "",
        //                         bgSize: "cover",
        //                         bgPosition: "center",
        //                         bgRepeat: "no-repeat",
        //                         pt: "",
        //                         pr: "",
        //                         pb: "",
        //                         pl: "",
        //                         mt: "",
        //                         mr: "",
        //                         mb: "",
        //                         ml: "",
        //                         classes: "",
        //                     },
        //                 };
        //                 divNode.children.push(sec);
        //                 renderCanvas();
        //                 updateLayers();
        //             }
        //         } else {
        //             // Add widget to div (existing logic)
        //             saveHistory();
        //             const comp = ALL_COMPONENTS.find((c) => c.type === activeDragType);
        //             const divNode = findDivWrapper(divId);
        //             if (divNode) {
        //                 const w = {
        //                     id: uid(),
        //                     type: activeDragType,
        //                     props: JSON.parse(JSON.stringify(comp ? comp.props : {})),
        //                     style: {
        //                         background: "",
        //                         padding: "",
        //                         margin: "",
        //                         border: "",
        //                         borderRadius: "",
        //                         color: "",
        //                         fontSize: "",
        //                         fontWeight: "",
        //                         textAlign: "",
        //                         opacity: "",
        //                         boxShadow: "",
        //                         bgImage: "",
        //                         bgSize: "cover",
        //                         bgPosition: "center",
        //                         bgRepeat: "no-repeat",
        //                         pt: "",
        //                         pr: "",
        //                         pb: "",
        //                         pl: "",
        //                         mt: "",
        //                         mr: "",
        //                         mb: "",
        //                         ml: "",
        //                         classes: "",
        //                     },
        //                 };
        //                 divNode.children.push(w);
        //                 renderCanvas();
        //                 updateLayers();
        //             }
        //         }
        //         activeDragType = null;
        //     } else if (dragData && dragData.type === "widget") {
        //         // Widget drag between divs or from col to div
        //         saveHistory();
        //         const found = findWidget(dragData.widgetId);
        //         if (!found) return;

        //         const divNode = findDivWrapper(divId);
        //         if (!divNode) return;

        //         // Remove from source
        //         if (found.inDiv) {
        //             found.divNode.children = found.divNode.children.filter(
        //                 (c) => c.id !== dragData.widgetId,
        //             );
        //         } else {
        //             found.col.widgets = found.col.widgets.filter(
        //                 (w) => w.id !== dragData.widgetId,
        //             );
        //         }

        //         // Add to target div
        //         divNode.children.push(found.widget);

        //         renderCanvas();
        //         updateLayers();
        //         dragData = null;
        //     }
        // }
        function handleDivDrop(divId) {
            if (activeDragType) {
                if (activeDragType === "__template__") {
                    const divNode = findDivWrapper(divId);
                    applyPendingTemplate(divNode ? divNode.children : null);
                    activeDragType = null;
                    return;
                }
                if (activeDragType === "div-wrapper") {
                    addDivWrapper(null, null, divId);
                } else if (activeDragType === "section") {
                    saveHistory();
                    const divNode = findDivWrapper(divId);
                    if (divNode) {
                        const sec = {
                            id: uid(),
                            type: "section",
                            cols: [{
                                id: uid(),
                                widgets: [],
                                width: 100,
                                flex: {
                                    flexDirection: "column",
                                    flexWrap: "nowrap",
                                    alignItems: "flex-start",
                                    justifyContent: "flex-start",
                                    gap: "0"
                                }
                            }],
                            style: {
                                background: "",
                                margin: "0",
                                borderRadius: "0",
                                border: "",
                                flexDirection: "row",
                                flexWrap: "wrap",
                                alignItems: "stretch",
                                justifyContent: "flex-start",
                                gap: "0",
                                minHeight: "",
                                bgImage: "",
                                bgSize: "cover",
                                bgPosition: "center",
                                bgRepeat: "no-repeat",
                                pt: "",
                                pr: "",
                                pb: "",
                                pl: "",
                                mt: "",
                                mr: "",
                                mb: "",
                                ml: "",
                                classes: ""
                            },
                        };
                        divNode.children.push(sec);
                        renderCanvas();
                        updateLayers();
                    }
                } else if (activeDragType === "bs-row") {
                    saveHistory();
                    const divNode = findDivWrapper(divId);
                    if (divNode) {
                        const sec = {
                            id: uid(),
                            type: "bs-row",
                            cols: [{
                                id: uid(),
                                widgets: [],
                                bsCol: "col-md-12",
                                flex: {
                                    flexDirection: "column",
                                    alignItems: "flex-start",
                                    justifyContent: "flex-start",
                                    gap: "0"
                                }
                            }],
                            style: {
                                background: "",
                                margin: "0",
                                borderRadius: "0",
                                border: "",
                                minHeight: "",
                                bgImage: "",
                                bgSize: "cover",
                                bgPosition: "center",
                                bgRepeat: "no-repeat",
                                pt: "",
                                pr: "",
                                pb: "",
                                pl: "",
                                mt: "",
                                mr: "",
                                mb: "",
                                ml: "",
                                classes: ""
                            },
                        };
                        divNode.children.push(sec);
                        renderCanvas();
                        updateLayers();
                    }
                } else {
                    saveHistory();
                    const comp = ALL_COMPONENTS.find((c) => c.type === activeDragType);
                    const divNode = findDivWrapper(divId);
                    if (divNode) {
                        const w = {
                            id: uid(),
                            type: activeDragType,
                            props: JSON.parse(JSON.stringify(comp ? comp.props : {})),
                            style: {
                                background: "",
                                padding: "",
                                margin: "",
                                border: "",
                                borderRadius: "",
                                color: "",
                                fontSize: "",
                                fontWeight: "",
                                textAlign: "",
                                opacity: "",
                                boxShadow: "",
                                bgImage: "",
                                bgSize: "cover",
                                bgPosition: "center",
                                bgRepeat: "no-repeat",
                                pt: "",
                                pr: "",
                                pb: "",
                                pl: "",
                                mt: "",
                                mr: "",
                                mb: "",
                                ml: "",
                                classes: ""
                            },
                        };
                        divNode.children.push(w);
                        renderCanvas();
                        updateLayers();
                    }
                }
                activeDragType = null;
            } else if (dragData && dragData.type === "widget") {
                saveHistory();
                const found = findWidget(dragData.widgetId);
                if (!found) return;
                const divNode = findDivWrapper(divId);
                if (!divNode) return;
                if (found.inDiv) {
                    found.divNode.children = found.divNode.children.filter(c => c.id !== dragData.widgetId);
                } else {
                    found.col.widgets = found.col.widgets.filter(w => w.id !== dragData.widgetId);
                }
                divNode.children.push(found.widget);
                renderCanvas();
                updateLayers();
                dragData = null;
            }
        }

        // ============================
        // CANVAS RENDER
        // ============================
        function renderCanvas() {
            const canvas = document.getElementById("canvas");
            canvas.innerHTML = "";
            if (sections.length === 0) {
                canvas.innerHTML =
                    '<div class="empty-state"><i class="fa fa-wand-magic-sparkles"></i><p>Drag elements from the left panel or click "Add Section"</p></div>';
            } else {
                sections.forEach((s) => {
                    if (s.type === "section" || s.type === "bs-row")
                        canvas.appendChild(buildSectionEl(s));
                    else if (s.nodeType === "div") canvas.appendChild(buildDivEl(s));
                });
            }

            initSortableSystem();
        }

        // ============================
        // SELECTION & PROPS
        // ============================
        function selectSection(id) {
            selectedId = id;
            selectedType = "section";
            const sec = findSection(id);
            if (!sec) return;
            document.getElementById("propPanelTitle").textContent =
                sec.type === "bs-row" ? "BS Row Settings" : "Section Settings";
            document.getElementById("propPanelBody").innerHTML =
                buildSectionPropsHTML(sec);
        }

        function selectDiv(id) {
            selectedId = id;
            selectedType = "div";
            const div = findDivWrapper(id);
            if (!div) return;
            document.getElementById("propPanelTitle").textContent =
                "Div Wrapper Settings";
            document.getElementById("propPanelBody").innerHTML = buildDivPropsHTML(div);
        }

        function selectWidget(id) {
            selectedId = id;
            selectedType = "widget";
            const found = findWidget(id);
            if (!found) return;
            document.getElementById("propPanelTitle").textContent = "Widget Properties";
            document.getElementById("propPanelBody").innerHTML = buildWidgetPropsHTML(
                found.widget,
                found.section,
                found.col,
            );
        }

        function clearPropPanel() {
            selectedId = null;
            selectedType = null;
            document.getElementById("propPanelTitle").textContent = "Properties";
            document.getElementById("propPanelBody").innerHTML =
                '<div class="prop-panel-empty"><i class="fa fa-arrow-pointer"></i>Click any element to edit</div>';
        }

        // ============================
        // SPACING FIELD HTML helper
        // ============================
        function spacingFields(prefix, label, sty, updateFn) {
            return `<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand"></i>${label}</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(sty[prefix + "t"] || sty.padding || sty.margin || "")}" placeholder="0" onchange="${updateFn}('${prefix}t',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(sty[prefix + "r"] || sty.padding || sty.margin || "")}" placeholder="0" onchange="${updateFn}('${prefix}r',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(sty[prefix + "b"] || sty.padding || sty.margin || "")}" placeholder="0" onchange="${updateFn}('${prefix}b',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(sty[prefix + "l"] || sty.padding || sty.margin || "")}" placeholder="0" onchange="${updateFn}('${prefix}l',this.value)"></div>
</div>
</div>`;
        }

        // ============================
        // PROPS HTML - SECTION
        // ============================
        function buildSectionPropsHTML(sec) {
            const sty = sec.style || {};
            const isBsRow = sec.type === "bs-row";
            let colsHTML = "";
            if (isBsRow) {
                colsHTML = `<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-grip"></i> Bootstrap Columns</div>
<div class="bs-col-builder" id="bs-cols-${sec.id}">
${sec.cols
    .map(
        (col, i) => `<div class="bs-col-row">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <label>Col ${i + 1}</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <select onchange="updateBsColClass('${sec.id}','${col.id}',this.value)">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${["col-12", "col-md-1", "col-md-2", "col-md-3", "col-md-4", "col-md-5", "col-md-6", "col-md-7", "col-md-8", "col-md-9", "col-md-10", "col-md-11", "col-md-12", "col-lg-3", "col-lg-4", "col-lg-6", "col-lg-8", "col"].map((v) => `<option value="${v}" ${col.bsCol === v ? "selected" : ""}>${v}</option>`).join("")}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <button onclick="removeBsCol('${sec.id}','${col.id}')"><i class="fa fa-xmark"></i></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>`,
    )
    .join("")}
</div>
<button class="add-item-btn" style="margin-top:5px" onclick="addBsCol('${sec.id}')"><i class="fa fa-plus"></i> Add Column</button>
</div>`;
            } else {
                colsHTML = `<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-table-columns"></i> Columns</div>
<div class="layout-presets">
${[1, 2, 3, 4].map((n) => `<div class="layout-preset ${sec.cols.length === n ? "active" : ""}" onclick="setSectionCols('${sec.id}',${n})"><div class="layout-preset-vis">${Array(n).fill('<div class="lp-col" style="flex:1"></div>').join("")}</div><div class="layout-preset-label">${n} Col${n > 1 ? "s" : ""}</div></div>`).join("")}
</div>
<div class="col-row-manage">
${sec.cols.map((col, i) => `<div class="col-row-item"><label>Col ${i + 1}</label><input type="number" min="5" max="100" value="${col.width || Math.floor(100 / sec.cols.length)}" onchange="setColWidth('${sec.id}','${col.id}',this.value)"><span style="font-size:9px;color:var(--text3)">%</span><button style="background:none;border:none;cursor:pointer;color:var(--text3);font-size:10px" onclick="openColFlexProps('${sec.id}','${col.id}')"><i class="fa fa-arrows-to-dot"></i></button></div>`).join("")}
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-layer-group"></i> Flexbox (Row)</div>
<div class="prop-field"><label>Direction</label>
<div class="btn-group">${["row", "column", "row-reverse", "column-reverse"].map((v) => `<button class="${(sty.flexDirection || "row") === v ? "active" : ""}" onclick="updateSectionStyle('${sec.id}','flexDirection','${v}')">${v}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Wrap</label>
<div class="btn-group">${["wrap", "nowrap", "wrap-reverse"].map((v) => `<button class="${(sty.flexWrap || "wrap") === v ? "active" : ""}" onclick="updateSectionStyle('${sec.id}','flexWrap','${v}')">${v}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Align Items</label>
<div class="btn-group">${["stretch", "flex-start", "flex-end", "center", "baseline"].map((v) => `<button class="${(sty.alignItems || "stretch") === v ? "active" : ""}" onclick="updateSectionStyle('${sec.id}','alignItems','${v}')">${v.replace("flex-", "")}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Justify Content</label>
<div class="btn-group">${["flex-start", "flex-end", "center", "space-between", "space-around", "space-evenly"].map((v) => `<button class="${(sty.justifyContent || "flex-start") === v ? "active" : ""}" onclick="updateSectionStyle('${sec.id}','justifyContent','${v}')">${v.replace("flex-", "")}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Gap</label><input type="text" value="${esc(sty.gap || "0")}" onchange="updateSectionStyle('${sec.id}','gap',this.value)"></div>
</div>`;
            }

            return (
                colsHTML +
                `
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-palette"></i> Appearance</div>
<div class="prop-field"><label>Classes</label><input type="text" value="${esc(sty.classes || "")}" placeholder="container row d-flex..." onchange="updateSectionStyle('${sec.id}','classes',this.value)"></div>
<div class="prop-field"><label>Background</label><input type="text" value="${esc(sty.background || "")}" placeholder="#fff or gradient..." onchange="updateSectionStyle('${sec.id}','background',this.value)"></div>
<div class="prop-field"><label>BG Color Picker</label><input type="color" value="${sty.background && sty.background.startsWith("#") ? sty.background : "#ffffff"}" onchange="updateSectionStyle('${sec.id}','background',this.value)"></div>
<div class="prop-field"><label>Background Image</label>
<div class="bg-img-picker" onclick="openFM(url=>{updateSectionStyle('${sec.id}','bgImage',url);})">
<i class="fa fa-image"></i><span>${sty.bgImage ? "Change Image" : "Pick from Media"}</span>
</div>
${sty.bgImage ? `<div class="bg-img-preview"><img src="${esc(sty.bgImage)}" alt=""><button class="remove-bg" onclick="updateSectionStyle('${sec.id}','bgImage','')">✕</button></div>` : ""}
</div>
${
    sty.bgImage
        ? `<div class="prop-field-row">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="prop-field"><label>BG Size</label><select onchange="updateSectionStyle('${sec.id}','bgSize',this.value)">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${["cover", "contain", "auto", "100% 100%"].map((v) => `<option value="${v}" ${sty.bgSize === v ? "selected" : ""}>${v}</option>`).join("")}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </select></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="prop-field"><label>BG Position</label><select onchange="updateSectionStyle('${sec.id}','bgPosition',this.value)">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${["center", "top", "bottom", "left", "right", "center top", "center bottom"].map((v) => `<option value="${v}" ${sty.bgPosition === v ? "selected" : ""}>${v}</option>`).join("")}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </select></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="prop-field"><label>BG Repeat</label><div class="btn-group">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${["no-repeat", "repeat", "repeat-x", "repeat-y"].map((v) => `<button class="${(sty.bgRepeat || "no-repeat") === v ? "active" : ""}" onclick="updateSectionStyle('${sec.id}','bgRepeat','${v}')">${v}</button>`).join("")}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div></div>`
        : ""
}
<div class="prop-field-row">
<div class="prop-field"><label>Border</label><input type="text" value="${esc(sty.border || "")}" placeholder="1px solid #ccc" onchange="updateSectionStyle('${sec.id}','border',this.value)"></div>
<div class="prop-field"><label>Radius</label><input type="text" value="${esc(sty.borderRadius || "")}" placeholder="8px" onchange="updateSectionStyle('${sec.id}','borderRadius',this.value)"></div>
</div>
<div class="prop-field"><label>Min Height</label><input type="text" value="${esc(sty.minHeight || "")}" placeholder="300px" onchange="updateSectionStyle('${sec.id}','minHeight',this.value)"></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand-arrows-alt"></i> Padding (px / rem)</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(sty.pt || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(sty.pr || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(sty.pb || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(sty.pl || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pl',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-arrows-left-right"></i> Margin</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(sty.mt || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','mt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(sty.mr || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','mr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(sty.mb || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','mb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(sty.ml || "")}" placeholder="0" onchange="updateSectionStyle('${sec.id}','ml',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-plus"></i> Add Inner Section</div>
${sec.cols.map((col, i) => `<button class="add-item-btn" style="margin-bottom:3px" onclick="addSection('${sec.id}','${col.id}')"><i class="fa fa-plus"></i> Inner Section → Col ${i + 1}</button><button class="add-item-btn" style="margin-bottom:3px" onclick="addBsRowSection('${sec.id}','${col.id}')"><i class="fa fa-grip"></i> BS Row → Col ${i + 1}</button><button class="add-item-btn" style="margin-bottom:5px" onclick="addDivWrapper('${sec.id}','${col.id}')"><i class="fa fa-code"></i> Div → Col ${i + 1}</button>`).join("")}
</div>`
            );
        }

        // ============================
        // PROPS HTML - DIV WRAPPER
        // ============================
        function buildDivPropsHTML(div) {
            const s = div.inlineStyles || {};
            return `
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-code"></i> Div Attributes</div>
<div class="prop-field"><label>Classes</label><input type="text" value="${esc(div.divClasses || "")}" placeholder="container row d-flex fw-bold..." onchange="updateDivProp('${div.id}','divClasses',this.value)"></div>
<div class="prop-field"><label>Inline Style (raw CSS)</label><textarea placeholder="color:red; font-size:14px;" onchange="updateDivProp('${div.id}','divStyle',this.value)">${esc(div.divStyle || "")}</textarea></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-palette"></i> Visual Styles</div>
<div class="prop-field"><label>Background</label><input type="text" value="${esc(s.background || "")}" placeholder="transparent" onchange="updateDivStyle('${div.id}','background',this.value)"></div>
<div class="prop-field"><label>BG Color</label><input type="color" value="${s.background && s.background.startsWith("#") ? s.background : "#ffffff"}" onchange="updateDivStyle('${div.id}','background',this.value)"></div>
<div class="prop-field"><label>Background Image</label>
<div class="bg-img-picker" onclick="openFM(url=>{updateDivStyle('${div.id}','bgImage',url);})">
<i class="fa fa-image"></i><span>${s.bgImage ? "Change Image" : "Pick from Media"}</span>
</div>
${s.bgImage ? `<div class="bg-img-preview"><img src="${esc(s.bgImage)}" alt=""><button class="remove-bg" onclick="updateDivStyle('${div.id}','bgImage','')">✕</button></div>` : ""}
</div>
${
    s.bgImage
        ? `<div class="prop-field-row">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="prop-field"><label>BG Size</label><select onchange="updateDivStyle('${div.id}','bgSize',this.value)">${["cover", "contain", "auto"].map((v) => `<option ${s.bgSize === v ? "selected" : ""}>${v}</option>`).join("")}</select></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="prop-field"><label>BG Pos</label><select onchange="updateDivStyle('${div.id}','bgPosition',this.value)">${["center", "top", "bottom", "left", "right"].map((v) => `<option ${s.bgPosition === v ? "selected" : ""}>${v}</option>`).join("")}</select></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>`
        : ""
}
<div class="prop-field-row">
<div class="prop-field"><label>Border</label><input type="text" value="${esc(s.border || "")}" placeholder="1px solid" onchange="updateDivStyle('${div.id}','border',this.value)"></div>
<div class="prop-field"><label>Radius</label><input type="text" value="${esc(s.borderRadius || "")}" placeholder="6px" onchange="updateDivStyle('${div.id}','borderRadius',this.value)"></div>
</div>
<div class="prop-field-row">
<div class="prop-field"><label>Width</label><input type="text" value="${esc(s.width || "")}" placeholder="100%" onchange="updateDivStyle('${div.id}','width',this.value)"></div>
<div class="prop-field"><label>Height</label><input type="text" value="${esc(s.height || "")}" placeholder="auto" onchange="updateDivStyle('${div.id}','height',this.value)"></div>
</div>
<div class="prop-field"><label>Color</label><input type="text" value="${esc(s.color || "")}" placeholder="inherit" onchange="updateDivStyle('${div.id}','color',this.value)"></div>
<div class="prop-field"><label>Font Size</label><input type="text" value="${esc(s.fontSize || "")}" placeholder="14px" onchange="updateDivStyle('${div.id}','fontSize',this.value)"></div>
<div class="prop-field"><label>Display</label>
<div class="btn-group">${["block", "flex", "grid", "inline", "inline-block", "inline-flex", "none"].map((v) => `<button class="${s.display === v ? "active" : ""}" onclick="updateDivStyleDirect('${div.id}','display','${v}')">${v}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Flex Direction</label>
<div class="btn-group">${["row", "column", "row-reverse", "column-reverse"].map((v) => `<button class="${s.flexDirection === v ? "active" : ""}" onclick="updateDivStyleDirect('${div.id}','flexDirection','${v}')">${v}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Align Items</label>
<div class="btn-group">${["flex-start", "flex-end", "center", "stretch", "baseline"].map((v) => `<button class="${s.alignItems === v ? "active" : ""}" onclick="updateDivStyleDirect('${div.id}','alignItems','${v}')">${v.replace("flex-", "")}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Justify Content</label>
<div class="btn-group">${["flex-start", "flex-end", "center", "space-between", "space-around"].map((v) => `<button class="${s.justifyContent === v ? "active" : ""}" onclick="updateDivStyleDirect('${div.id}','justifyContent','${v}')">${v.replace("flex-", "")}</button>`).join("")}</div>
</div>
<div class="prop-field"><label>Gap</label><input type="text" value="${esc(s.gap || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','gap',this.value)"></div>
<div class="prop-field"><label>Box Shadow</label><input type="text" value="${esc(s.boxShadow || "")}" placeholder="0 2px 8px rgba(0,0,0,.1)" onchange="updateDivStyle('${div.id}','boxShadow',this.value)"></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand-arrows-alt"></i> Padding</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.pt || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','pt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.pr || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','pr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.pb || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','pb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.pl || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','pl',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-arrows-left-right"></i> Margin</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.mt || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','mt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.mr || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','mr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.mb || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','mb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.ml || "")}" placeholder="0" onchange="updateDivStyle('${div.id}','ml',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-code"></i> Nested</div>
<button class="add-item-btn" onclick="addDivWrapper(null,null,'${div.id}')"><i class="fa fa-plus"></i> Add Nested &lt;div&gt;</button>
</div>
<div style="display:flex;gap:5px;margin-top:4px">
<button class="add-item-btn" style="color:var(--accent2);border-color:rgba(224,82,82,.3)" onclick="removeDiv('${div.id}')"><i class="fa fa-trash"></i> Delete Div</button>
</div>`;
        }

        // ============================
        // PROPS HTML - WIDGET
        // ============================
        function buildWidgetPropsHTML(widget, section, col) {
            const p = widget.props || {};
            const s = widget.style || {};
            let content = "";
            switch (widget.type) {
                case "heading":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-heading"></i> Content</div>
<div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text || "")}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
<div class="prop-field"><label>Subtitle</label><input type="text" value="${esc(p.sub || "")}" onchange="updateWidgetProp('${widget.id}','sub',this.value)"></div>
<div class="prop-field"><label>Level</label><div class="btn-group">${["h1", "h2", "h3", "h4"].map((v) => `<button class="${(p.level || "h2") === v ? "active" : ""}" onclick="updateWidgetPropDirect('${widget.id}','level','${v}')">${v.toUpperCase()}</button>`).join("")}</div></div></div>`;
                    break;
                case "text":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-align-left"></i> Content</div><div class="prop-field"><label>Content</label><textarea onchange="updateWidgetProp('${widget.id}','content',this.value)">${esc(p.content || "")}</textarea></div></div>`;
                    break;
                case "button":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-arrow-pointer"></i> Button</div>
<div class="prop-field"><label>Label</label><input type="text" value="${esc(p.label || "")}" onchange="updateWidgetProp('${widget.id}','label',this.value)"></div>
<div class="prop-field"><label>URL</label><input type="url" value="${esc(p.href || "")}" onchange="updateWidgetProp('${widget.id}','href',this.value)"></div>
<div class="prop-field"><label>Style</label><div class="btn-group">${["solid", "outline"].map((v) => `<button class="${(p.style || "solid") === v ? "active" : ""}" onclick="updateWidgetPropDirect('${widget.id}','style','${v}')">${v}</button>`).join("")}</div></div></div>`;
                    break;
                case "image":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-image"></i> Image</div>
<div class="prop-field"><label>Image</label>
<div class="image-wrapper">
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetProp('${widget.id}','src',url);document.getElementById('img-prev-${widget.id}').src=url;document.getElementById('img-prev-wrap-${widget.id}').style.display='block';})"><i class="fa fa-images"></i> Pick from Media</button>
<div class="image-preview-box" id="img-prev-wrap-${widget.id}" style="${p.src ? "" : "display:none"}"><img id="img-prev-${widget.id}" src="${esc(p.src || "")}" alt=""><button class="remove-img-btn" onclick="updateWidgetProp('${widget.id}','src','');document.getElementById('img-prev-wrap-${widget.id}').style.display='none'">✕</button></div>
<div class="prop-field" style="margin-top:5px"><label>Or paste URL</label><input type="url" value="${esc(p.src || "")}" placeholder="https://..." onchange="updateWidgetProp('${widget.id}','src',this.value)"></div>
</div>
</div>
<div class="prop-field"><label>Alt Text</label><input type="text" value="${esc(p.alt || "")}" onchange="updateWidgetProp('${widget.id}','alt',this.value)"></div><div class="prop-field"><label>Image Size</label><div class="btn-group">${["small", "medium", "large", "original"].map(v => `<button class="${(p.size || "original") === v ? "active" : ""}" onclick="updateWidgetPropDirect('${widget.id}','size','${v}')"> ${v.charAt(0).toUpperCase() + v.slice(1)} </button>`).join("")}</div></div></div>`;
                    break;
                case "card-img":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-id-card"></i> Image Card</div>
<div class="prop-field"><label>Image</label>
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetProp('${widget.id}','img',url);})"><i class="fa fa-images"></i> Pick from Media</button>
<div class="prop-field" style="margin-top:5px"><label>Or paste URL</label><input type="url" value="${esc(p.img || "")}" onchange="updateWidgetProp('${widget.id}','img',this.value)"></div>
</div>
<div class="prop-field"><label>Title</label><input type="text" value="${esc(p.title || "")}" onchange="updateWidgetProp('${widget.id}','title',this.value)"></div>
<div class="prop-field"><label>Description</label><textarea onchange="updateWidgetProp('${widget.id}','desc',this.value)">${esc(p.desc || "")}</textarea></div><div class="prop-field"><label>Button Text</label><input type="text" onchange="updateWidgetProp('${widget.id}','btnText',this.value)" value="${esc(p.btnText || "")}"/></div><div class="prop-field"><label>Button Url</label><input type="text" onchange="updateWidgetProp('${widget.id}','btnUrl',this.value)" value="${esc(p.btnUrl || "")}"/></div></div>`;
                    break;
                case "icon-card":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-star"></i> Icon Card</div>
<div class="prop-field"><label>Icon (fa-...)</label><input type="text" value="${esc(p.icon || "")}" onchange="updateWidgetProp('${widget.id}','icon',this.value)"></div>
<div class="prop-field"><label>Title</label><input type="text" value="${esc(p.title || "")}" onchange="updateWidgetProp('${widget.id}','title',this.value)"></div>
<div class="prop-field"><label>Description</label><textarea onchange="updateWidgetProp('${widget.id}','desc',this.value)">${esc(p.desc || "")}</textarea></div></div>`;
                    break;
                case "icon":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-icons"></i> Icon</div>
<div class="prop-field"><label>Icon name (without fa-)</label><input type="text" value="${esc(p.icon || "")}" placeholder="star, heart, rocket..." onchange="updateWidgetProp('${widget.id}','icon',this.value)"></div></div>`;
                    break;
                case "divider":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-minus"></i> Divider</div>
<div class="prop-field"><label>Style</label><div class="btn-group">${["solid", "dashed", "dotted"].map((v) => `<button class="${(p.style || "solid") === v ? "active" : ""}" onclick="updateWidgetPropDirect('${widget.id}','style','${v}')">${v}</button>`).join("")}</div></div></div>`;
                    break;
                case "spacer":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-arrows-up-down"></i> Spacer</div>
<div class="prop-field"><label>Height (px)</label><input type="number" value="${p.height || 40}" min="4" max="400" onchange="updateWidgetProp('${widget.id}','height',this.value)"></div></div>`;
                    break;
                case "video":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-play-circle"></i> Video</div>
<div class="prop-field"><label>Embed URL</label><input type="url" value="${esc(p.url || "")}" onchange="updateWidgetProp('${widget.id}','url',this.value)"></div></div>`;
                    break;
                case "html":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-code"></i> HTML</div>
<div class="prop-field"><label>Code</label><textarea rows="5" style="font-family:monospace" onchange="updateWidgetProp('${widget.id}','code',this.value)">${esc(p.code || "")}</textarea></div></div>`;
                    break;
                case "testimonial":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-quote-left"></i> Testimonial</div>
<div class="prop-field"><label>Quote</label><textarea onchange="updateWidgetProp('${widget.id}','quote',this.value)">${esc(p.quote || "")}</textarea></div>
<div class="prop-field"><label>Author</label><input type="text" value="${esc(p.author || "")}" onchange="updateWidgetProp('${widget.id}','author',this.value)"></div>
<div class="prop-field"><label>Role</label><input type="text" value="${esc(p.role || "")}" onchange="updateWidgetProp('${widget.id}','role',this.value)"></div></div>`;
                    break;
                case "alert":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-triangle-exclamation"></i> Alert</div>
<div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text || "")}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
<div class="prop-field"><label>Type</label><div class="btn-group">${["info", "success", "warning", "danger"].map((v) => `<button class="${(p.alertType || "info") === v ? "active" : ""}" onclick="updateWidgetPropDirect('${widget.id}','alertType','${v}')">${v}</button>`).join("")}</div></div></div>`;
                    break;
                case "counter":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-hashtag"></i> Counter</div>
<div class="prop-field"><label>Number</label><input type="number" value="${p.num || 0}" onchange="updateWidgetProp('${widget.id}','num',+this.value)"></div>
<div class="prop-field-row"><div class="prop-field"><label>Prefix</label><input type="text" value="${esc(p.prefix || "")}" onchange="updateWidgetProp('${widget.id}','prefix',this.value)"></div>
<div class="prop-field"><label>Suffix</label><input type="text" value="${esc(p.suffix || "")}" onchange="updateWidgetProp('${widget.id}','suffix',this.value)"></div></div>
<div class="prop-field"><label>Label</label><input type="text" value="${esc(p.label || "")}" onchange="updateWidgetProp('${widget.id}','label',this.value)"></div></div>`;
                    break;
                case "badges":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-tags"></i> Badges</div>
<div class="items-list">${(p.items || []).map((t, i) => `<div class="item-row"><input value="${esc(t)}" onchange="updateArrItem('${widget.id}','items',${i},this.value)"><button onclick="removeArrItem('${widget.id}','items',${i})"><i class="fa fa-xmark"></i></button></div>`).join("")}</div>
<button class="add-item-btn" onclick="addArrItem('${widget.id}','items','New Badge')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case "list":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-list"></i> List</div>
<div class="prop-field"><label>Type</label><div class="btn-group">${["ul", "ol"].map((v) => `<button class="${(p.listType || "ul") === v ? "active" : ""}" onclick="updateWidgetPropDirect('${widget.id}','listType','${v}')">${v === "ul" ? "Unordered" : "Ordered"}</button>`).join("")}</div></div>
<div class="items-list">${(p.items || []).map((t, i) => `<div class="item-row"><input value="${esc(t)}" onchange="updateArrItem('${widget.id}','items',${i},this.value)"><button onclick="removeArrItem('${widget.id}','items',${i})"><i class="fa fa-xmark"></i></button></div>`).join("")}</div>
<button class="add-item-btn" onclick="addArrItem('${widget.id}','items','New item')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case "stats":
                    content = `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-chart-bar"></i> Stats</div>
<div class="items-list">${(p.items || []).map((it, i) => `<div class="item-row"><input value="${esc(it.num)}" placeholder="1000+" style="width:65px" onchange="updateStatItem('${widget.id}',${i},'num',this.value)"><input value="${esc(it.label)}" placeholder="Label" onchange="updateStatItem('${widget.id}',${i},'label',this.value)"><input value="${esc(it.icon)}" placeholder="fa-users" onchange="updateStatItem('${widget.id}',${i},'icon',this.value)"><button onclick="removeStatItem('${widget.id}',${i})"><i class="fa fa-xmark"></i></button></div>`).join("")}</div>
<button class="add-item-btn" onclick="addStatItem('${widget.id}')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                    case "process":
                    content = `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-right-long"></i> Process</div>
<div class="items-list">${(p.items || []).map((it, i) => `<div class="item-row"><input value="${esc(it.icon)}" placeholder="1000+" style="width:65px" onchange="updateStatItem('${widget.id}',${i},'icon',this.value)"><input value="${esc(it.text)}" placeholder="Label" onchange="updateStatItem('${widget.id}',${i},'text',this.value)"><input value="${esc(it.desc)}" placeholder="fa-users" onchange="updateStatItem('${widget.id}',${i},'desc',this.value)"><button onclick="removeStatItem('${widget.id}',${i})"><i class="fa fa-xmark"></i></button></div>`).join("")}</div>
<button class="add-item-btn" onclick="addProcessItem('${widget.id}')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case "progress":
                    content = `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-bars-progress"></i> Progress</div>
<div class="items-list">${(p.bars || []).map((b, i) => `<div class="item-row"><input value="${esc(b.label)}" placeholder="Label" onchange="updateProgressItem('${widget.id}',${i},'label',this.value)"><input type="number" value="${b.val}" min="0" max="100" style="width:52px" onchange="updateProgressItem('${widget.id}',${i},'val',+this.value)">%<button onclick="removeProgressItem('${widget.id}',${i})"><i class="fa fa-xmark"></i></button></div>`).join("")}</div>
<button class="add-item-btn" onclick="addProgressItem('${widget.id}')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case "accordion":
                    content = `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-chevron-down"></i> Accordion</div>
<div class="items-list">${(p.items || []).map((it, i) => `<div class="item-row" style="flex-direction:column;align-items:stretch;gap:3px"><input value="${esc(it.q)}" placeholder="Question" onchange="updateAccItem('${widget.id}',${i},'q',this.value)"><input value="${esc(it.a)}" placeholder="Answer" onchange="updateAccItem('${widget.id}',${i},'a',this.value)"><button onclick="removeAccItem('${widget.id}',${i})" style="align-self:flex-end"><i class="fa fa-xmark"></i></button></div>`).join("")}</div>
<button class="add-item-btn" onclick="addAccItem('${widget.id}')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case "theme-section":
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-layer-group"></i> Theme Block</div>
<div class="prop-field"><label>Title</label><input type="text" value="${esc(p.title || "")}" onchange="updateWidgetProp('${widget.id}','title',this.value)"></div>
<div class="prop-field"><label>Subtitle</label><input type="text" value="${esc(p.subtitle || "")}" onchange="updateWidgetProp('${widget.id}','subtitle',this.value)"></div>
<div class="prop-field"><label>Description</label><textarea onchange="updateWidgetProp('${widget.id}','desc',this.value)">${esc(p.desc || "")}</textarea></div>
<div class="prop-field"><label>Image</label>
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetProp('${widget.id}','image',url);})"><i class="fa fa-images"></i> Pick from Media</button>
<div class="prop-field" style="margin-top:4px"><input type="url" value="${esc(p.image || "")}" placeholder="or paste URL" onchange="updateWidgetProp('${widget.id}','image',this.value)"></div>
</div>
<div class="prop-field"><label>Button Text</label><input type="text" value="${esc(p.btnText || "")}" onchange="updateWidgetProp('${widget.id}','btnText',this.value)"></div>
<div class="prop-field"><label>Button URL</label><input type="url" value="${esc(p.btnUrl || "")}" onchange="updateWidgetProp('${widget.id}','btnUrl',this.value)"></div></div>`;
                    break;
                case "working-process-section":
                    content =
                        `<div class="prop-section">
            <div class="prop-section-title">
                <i class="fa fa-stairs"></i> Working Process
            </div>

            <div class="prop-field">
                <label>Title</label>
                <input type="text"
                    value="${esc(p.title || "")}"
                    onchange="updateWidgetProp('${widget.id}','title',this.value)">
            </div>

            <div class="prop-field">
                <label>Subtitle</label>
                <input type="text"
                    value="${esc(p.subtitle || "")}"
                    onchange="updateWidgetProp('${widget.id}','subtitle',this.value)">
            </div>

            <div class="items-list">
                ${(p.cards || []).map((card, i) => `
                                                                                                                                                                                                                        <div class="item-row"
                                                                                                                                                                                                                            style="flex-direction:column;align-items:stretch;gap:6px">

                                                                                                                                                                                                                            <input type="text"
                                                                                                                                                                                                                                placeholder="Icon (fa-rocket)"
                                                                                                                                                                                                                                value="${esc(card.icon || "")}"
                                                                                                                                                                                                                                onchange="updateWorkingCardItem('${widget.id}',${i},'icon',this.value)">

                                                                                                                                                                                                                            <input type="text"
                                                                                                                                                                                                                                placeholder="Title"
                                                                                                                                                                                                                                value="${esc(card.text || "")}"
                                                                                                                                                                                                                                onchange="updateWorkingCardItem('${widget.id}',${i},'text',this.value)">

                                                                                                                                                                                                                            <textarea
                                                                                                                                                                                                                                placeholder="Description"
                                                                                                                                                                                                                                onchange="updateWorkingCardItem('${widget.id}',${i},'desc',this.value)"
                                                                                                                                                                                                                            >${esc(card.desc || "")}</textarea>

                                                                                                                                                                                                                           
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    `).join("")}
            </div>

        </div>`;
                    break;

                case "heading-n":
                    content = `<div class="prop-section">
        <div class="prop-section-title"><i class="fa fa-heading"></i> Heading</div>
        <div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text || "")}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
        <div class="prop-field"><label>Level</label>
            <div class="btn-group">
                ${["h1", "h2", "h3", "h4", "h5", "h6"].map((v) => `<button class="${(p.level || "h2") === v ? "active" : ""}" onclick="updateWidgetPropDirect('${widget.id}','level','${v}')">${v}</button>`).join("")}
            </div>
        </div>
        <div class="prop-field"><label>Classes</label><input type="text" value="${esc(p.classes || "")}" placeholder="fw-bold text-center mb-0..." onchange="updateWidgetProp('${widget.id}','classes',this.value)"></div>
    </div>`;
                    break;
                case "subheading":
                    content = `<div class="prop-section">
        <div class="prop-section-title"><i class="fa fa-text-height"></i> Subheading</div>
        <div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text || "")}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
        <div class="prop-field"><label>Classes</label><input type="text" value="${esc(p.classes || "")}" placeholder="text-muted lead fst-italic..." onchange="updateWidgetProp('${widget.id}','classes',this.value)"></div>
    </div>`;
                    break;
                case "brands-listing":
                    content = `
        <div class="prop-section">
            <div class="prop-section-title"><i class="fa fa-building"></i> Brands Listing</div>
            <div class="items-list">
                ${(p.images || []).map((img, i) => `
                                                                                                                        <div class="brand-item-row">
                                                                                                                            <div class="image-preview-box" style="width:70px;height:40px;flex-shrink:0">
                                                                                                                                <img src="${esc(img)}" alt="Brand" style="width:100%;height:100%;object-fit:contain">
                                                                                                                            </div>
                                                                                                                            <input type="hidden" value="${esc(img)}" placeholder="Image URL" style="flex:1" onchange="updateBrandsItem('${widget.id}',${i},this.value)">
                                                                                                                            <button class="image-picker-btn" onclick="openFM(url=>{updateBrandsItem('${widget.id}',${i},url);renderCanvas();selectWidget('${widget.id}');})" style="padding:6px 8px"><i class="fa fa-image"></i></button>
                                                                                                                            <button onclick="removeBrandsItem('${widget.id}',${i})" style="background:none;border:none;color:var(--text3);cursor:pointer;padding:6px"><i class="fa fa-xmark"></i></button>
                                                                                                                        </div>
                                                                                                                    `).join("")}
            </div>
            <button class="add-item-btn" onclick="addBrandsItem('${widget.id}')"><i class="fa fa-plus"></i> Add Brand Image</button>
        </div>`;
                    break;
                case "shortcode":
                    content = `
        <div class="prop-section">
            <div class="prop-section-title"><i class="fa fa-code"></i> Shortcode Settings</div>
            <div class="prop-field">
                <label>Unique ID</label>
                <div style="display:flex;align-items:center;gap:6px">
                    <input type="text" value="${esc(p.id || "")}" placeholder="unique-shortcode-id" onchange="updateWidgetProp('${widget.id}','id',this.value)" style="flex:1">
                    ${p.id ? `<button onclick="navigator.clipboard.writeText('${p.id}')" title="Copy ID" style="background:none;border:none;color:var(--text3);cursor:pointer;font-size:11px;padding:4px"><i class="fa fa-copy"></i></button>` : ''}
                </div>
                <small style="color:var(--text3);font-size:9px;margin-top:2px;display:block">Use this ID to call this widget from code</small>
            </div>
        </div>`;
                    break;
                default:
                    content =
                        `<div class="prop-section"><p style="font-size:11px;color:var(--text3)">No properties for this widget.</p></div>`;
            }

            // Universal style section
            content += `
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-palette"></i> Widget Styling</div>
<div class="prop-field"><label>Classes</label><input type="text" value="${esc(s.classes || "")}" placeholder="d-flex justify-content-center..." onchange="updateWidgetStyle('${widget.id}','classes',this.value)"></div>
<div class="prop-field"><label>Background</label><input type="text" value="${esc(s.background || "")}" placeholder="transparent" onchange="updateWidgetStyle('${widget.id}','background',this.value)"></div>
<div class="prop-field"><label>Background Image</label>
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetStyleDirect('${widget.id}','bgImage',url);})"><i class="fa fa-images"></i> Pick BG Image</button>
${s.bgImage ? `<div class="bg-img-preview" style="margin-top:4px"><img src="${esc(s.bgImage)}" alt=""><button class="remove-bg" onclick="updateWidgetStyleDirect('${widget.id}','bgImage','')">✕</button></div>` : ""}
</div>
<div class="prop-field-row">
<div class="prop-field"><label>Color</label><input type="text" value="${esc(s.color || "")}" placeholder="inherit" onchange="updateWidgetStyle('${widget.id}','color',this.value)"></div>
<div class="prop-field"><label>Font Size</label><input type="text" value="${esc(s.fontSize || "")}" placeholder="14px" onchange="updateWidgetStyle('${widget.id}','fontSize',this.value)"></div>
</div>
<div class="prop-field"><label>Text Align</label>
<div class="btn-group">${["left", "center", "right", "justify"].map((v) => `<button class="${(s.textAlign || "") === v ? "active" : ""}" onclick="updateWidgetStyleDirect('${widget.id}','textAlign','${v}')"><i class="fa fa-align-${v === "justify" ? "justify" : v}"></i></button>`).join("")}</div>
</div>
<div class="prop-field"><label>Font Weight</label>
<div class="btn-group">${["400", "600", "700", "900"].map((v) => `<button class="${(s.fontWeight || "") === v ? "active" : ""}" onclick="updateWidgetStyleDirect('${widget.id}','fontWeight','${v}')">${v}</button>`).join("")}</div>
</div>
<div class="prop-field-row">
<div class="prop-field"><label>Border</label><input type="text" value="${esc(s.border || "")}" placeholder="1px solid" onchange="updateWidgetStyle('${widget.id}','border',this.value)"></div>
<div class="prop-field"><label>Radius</label><input type="text" value="${esc(s.borderRadius || "")}" placeholder="6px" onchange="updateWidgetStyle('${widget.id}','borderRadius',this.value)"></div>
</div>
<div class="prop-field"><label>Box Shadow</label><input type="text" value="${esc(s.boxShadow || "")}" placeholder="0 2px 8px rgba(0,0,0,.1)" onchange="updateWidgetStyle('${widget.id}','boxShadow',this.value)"></div>
<div class="prop-field"><label>Opacity</label><input type="range" min="0" max="1" step="0.05" value="${s.opacity || 1}" oninput="updateWidgetStyle('${widget.id}','opacity',+this.value)"></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand-arrows-alt"></i> Padding</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.pt || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.pr || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.pb || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.pl || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pl',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-arrows-left-right"></i> Margin</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.mt || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','mt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.mr || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','mr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.mb || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','mb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.ml || "")}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','ml',this.value)"></div>
</div>
</div>
<div style="display:flex;gap:5px;margin-top:3px">
<button class="add-item-btn" onclick="duplicateWidget('${widget.id}')"><i class="fa fa-copy"></i> Duplicate</button>
<button class="add-item-btn" style="color:var(--accent2);border-color:rgba(224,82,82,.3)" onclick="removeWidget('${widget.id}')"><i class="fa fa-trash"></i> Delete</button>
</div>`;

            return content;
        }

        // ============================
        // UPDATE HELPERS
        // ============================
        function updateBrandsItem(wid, i, v) {
            const f = findWidget(wid);
            if (f) {
                f.widget.props.images[i] = v;
                refreshWidget(wid);
            }
        }

        function removeBrandsItem(wid, i) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.images.splice(i, 1);
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function addBrandsItem(wid) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.images.push("https://picsum.photos/seed/brand" + (f.widget.props.images.length + 1) +
                    "/150/50");
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function esc(v) {
            return String(v)
                .replace(/&/g, "&amp;")
                .replace(/"/g, "&quot;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;");
        }

        function updateSectionStyle(secId, prop, val) {
            const sec = findSection(secId);
            if (!sec) return;
            if (!sec.style) sec.style = {};
            sec.style[prop] = val;
            renderCanvas();
            requestAnimationFrame(() => selectSection(secId));
        }

        function setSectionCols(secId, n) {
            saveHistory();
            const sec = findSection(secId);
            if (!sec) return;
            while (sec.cols.length < n)
                sec.cols.push({
                    id: uid(),
                    widgets: [],
                    width: Math.floor(100 / n),
                    flex: {},
                });
            while (sec.cols.length > n) {
                const extra = sec.cols.pop();
                if (extra.widgets.length) sec.cols[0].widgets.push(...extra.widgets);
            }
            sec.cols.forEach((c) => (c.width = Math.floor(100 / n)));
            renderCanvas();
            requestAnimationFrame(() => selectSection(secId));
        }

        function setColWidth(secId, colId, val) {
            const sec = findSection(secId);
            const col = sec.cols.find((c) => c.id === colId);
            if (col) {
                col.width = parseInt(val) || 10;
                renderCanvas();
                requestAnimationFrame(() => selectSection(secId));
            }
        }

        function updateWorkingCardItem(widgetId, index, key, value) {

            const found = findWidget(widgetId);

            if (!found || !found.widget?.props?.cards) return;

            found.widget.props.cards[index][key] = value;

            renderCanvas();
        }



        function openColFlexProps(secId, colId) {
            const sec = findSection(secId);
            const col = sec.cols.find((c) => c.id === colId);
            const cf = col.flex || {};
            document.getElementById("propPanelTitle").textContent = "Column Flex";
            document.getElementById("propPanelBody").innerHTML = `
<div class="prop-section">
<button style="background:none;border:none;color:var(--accent);cursor:pointer;font-size:11px;margin-bottom:8px" onclick="selectSection('${secId}')">← Back to Section</button>
<div class="prop-section-title"><i class="fa fa-layer-group"></i> Column Flex</div>
<div class="prop-field"><label>Direction</label><div class="btn-group">${["column", "row", "row-reverse", "column-reverse"].map((v) => `<button class="${(cf.flexDirection || "column") === v ? "active" : ""}" onclick="updateColFlex('${secId}','${colId}','flexDirection','${v}')">${v}</button>`).join("")}</div></div>
<div class="prop-field"><label>Align Items</label><div class="btn-group">${["flex-start", "flex-end", "center", "stretch"].map((v) => `<button class="${(cf.alignItems || "flex-start") === v ? "active" : ""}" onclick="updateColFlex('${secId}','${colId}','alignItems','${v}')">${v.replace("flex-", "")}</button>`).join("")}</div></div>
<div class="prop-field"><label>Justify Content</label><div class="btn-group">${["flex-start", "flex-end", "center", "space-between", "space-around"].map((v) => `<button class="${(cf.justifyContent || "flex-start") === v ? "active" : ""}" onclick="updateColFlex('${secId}','${colId}','justifyContent','${v}')">${v.replace("flex-", "")}</button>`).join("")}</div></div>
<div class="prop-field"><label>Gap</label><input type="text" value="${cf.gap || "0"}" onchange="updateColFlex('${secId}','${colId}','gap',this.value)"></div>
</div>`;
        }

        function updateColFlex(secId, colId, prop, val) {
            saveHistory();
            const sec = findSection(secId);
            const col = sec.cols.find((c) => c.id === colId);
            if (!col.flex) col.flex = {};
            col.flex[prop] = val;
            renderCanvas();
            openColFlexProps(secId, colId);
        }

        function updateBsColClass(secId, colId, val) {
            const sec = findSection(secId);
            const col = sec.cols.find((c) => c.id === colId);
            if (col) {
                col.bsCol = val;
                renderCanvas();
                requestAnimationFrame(() => selectSection(secId));
            }
        }

        function addBsCol(secId) {
            saveHistory();
            const sec = findSection(secId);
            sec.cols.push({
                id: uid(),
                widgets: [],
                bsCol: "col-md-6",
                flex: {},
            });
            renderCanvas();
            requestAnimationFrame(() => selectSection(secId));
        }

        function removeBsCol(secId, colId) {
            saveHistory();
            const sec = findSection(secId);
            const idx = sec.cols.findIndex((c) => c.id === colId);
            if (idx >= 0) {
                const extra = sec.cols.splice(idx, 1)[0];
                if (extra.widgets.length && sec.cols.length > 0)
                    sec.cols[0].widgets.push(...extra.widgets);
            }
            renderCanvas();
            requestAnimationFrame(() => selectSection(secId));
        }

        // Div updates
        function updateDivProp(divId, prop, val) {
            const div = findDivWrapper(divId);
            if (!div) return;
            div[prop] = val;
            renderCanvas();
            requestAnimationFrame(() => selectDiv(divId));
        }

        function updateDivStyle(divId, prop, val) {
            const div = findDivWrapper(divId);
            if (!div) return;
            if (!div.inlineStyles) div.inlineStyles = {};
            div.inlineStyles[prop] = val;
            renderCanvas();
            requestAnimationFrame(() => selectDiv(divId));
        }

        function updateDivStyleDirect(divId, prop, val) {
            updateDivStyle(divId, prop, val);
        }

        // Widget updates
        function updateWidgetProp(widgetId, prop, val) {
            console.log(widgetId, prop, val)
            const found = findWidget(widgetId);
            if (!found) return;
            found.widget.props[prop] = val;
            const el = document.getElementById(widgetId);
            if (el) {
                const body = el.querySelector(".widget-body");
                if (body) body.innerHTML = renderWidgetContent(found.widget);
            }
        }

        function updateWidgetPropDirect(widgetId, prop, val) {
            updateWidgetProp(widgetId, prop, val);
            requestAnimationFrame(() => selectWidget(widgetId));
        }

        function updateWidgetStyle(widgetId, prop, val) {
            const found = findWidget(widgetId);
            if (!found) return;
            if (!found.widget.style) found.widget.style = {};
            found.widget.style[prop] = val;
            const el = document.getElementById(widgetId);
            if (el) {
                const styleProps = {
                    background: "background",
                    border: "border",
                    borderRadius: "borderRadius",
                    boxShadow: "boxShadow",
                    opacity: "opacity",
                    color: "color",
                    fontSize: "fontSize",
                    fontWeight: "fontWeight",
                    textAlign: "textAlign",
                };
                if (styleProps[prop]) el.style[prop] = val;
                if (prop === "bgImage") renderCanvas();
            }
        }

        function updateWidgetStyleDirect(widgetId, prop, val) {
            updateWidgetStyle(widgetId, prop, val);
            requestAnimationFrame(() => selectWidget(widgetId));
        }

        // Array item helpers (badges, list)
        function updateArrItem(wid, key, i, v) {
            const f = findWidget(wid);
            if (f) {
                f.widget.props[key][i] = v;
                refreshWidget(wid);
            }
        }

        function removeArrItem(wid, key, i) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props[key].splice(i, 1);
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function addArrItem(wid, key, def) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props[key].push(def);
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function updateStatItem(wid, i, k, v) {
            const f = findWidget(wid);
            if (f) {
                f.widget.props.items[i][k] = v;
                refreshWidget(wid);
            }
        }

        function removeStatItem(wid, i) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.items.splice(i, 1);
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function addStatItem(wid) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.items.push({
                    num: "0",
                    label: "Label",
                });
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }
        function addProcessItem(wid) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.items.push({
                    icon: "fa-rocket",
                    text: "Label",
                    desc:"Desc"
                });
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function updateProgressItem(wid, i, k, v) {
            const f = findWidget(wid);
            if (f) {
                f.widget.props.bars[i][k] = v;
                refreshWidget(wid);
            }
        }

        function removeProgressItem(wid, i) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.bars.splice(i, 1);
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function addProgressItem(wid) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.bars.push({
                    label: "Skill",
                    val: 50,
                });
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function updateAccItem(wid, i, k, v) {
            const f = findWidget(wid);
            if (f) {
                f.widget.props.items[i][k] = v;
                refreshWidget(wid);
            }
        }

        function removeAccItem(wid, i) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.items.splice(i, 1);
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function addAccItem(wid) {
            saveHistory();
            const f = findWidget(wid);
            if (f) {
                f.widget.props.items.push({
                    q: "Question?",
                    a: "Answer here.",
                });
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function refreshWidget(wid) {
            const el = document.getElementById(wid);
            if (el) {
                const body = el.querySelector(".widget-body");
                const found = findWidget(wid);
                if (body && found) body.innerHTML = renderWidgetContent(found.widget);
            }
        }

        // ============================
        // FILE MANAGER
        // ============================
        let nearestInput = null;
        let nearestWrapper = null;
        let selected_image = null;
        let fmCallback = null;
        let currentPage = 1;
        let totalPages = 1;
        let fmImages = [];

        function openFM(callback) {
            fmCallback = callback;
            selected_image = null;
            fmSelectedUrl = null;
            document.getElementById("fmUrlInput").value = "";
            document
                .querySelectorAll(".fm-img-item")
                .forEach((i) => i.classList.remove("selected"));
            document.getElementById("fmModal").style.display = "flex";
            loadImages(1, false);
            initDmUploader();
        }

        function closeFM() {
            document.getElementById("fmModal").style.display = "none";
            fmCallback = null;
            nearestInput = null;
            nearestWrapper = null;
            selected_image = null;
        }

        function confirmFMSelect() {
            const urlInput = document.getElementById("fmUrlInput").value.trim();
            const url = urlInput || selected_image;
            if (!url) {
                alert("Please select an image or paste a URL.");
                return;
            }
            if (fmCallback) fmCallback(url);
            closeFM();
        }

        function selectFMImage(url, el) {
            document
                .querySelectorAll(".fm-img-item")
                .forEach((i) => i.classList.remove("selected"));
            el.classList.add("selected");
            selected_image = url;
            document.getElementById("fmUrlInput").value = url;
            updateSelectBtn();
        }

        function updateSelectBtn() {
            const hasSelection =
                selected_image || document.getElementById("fmUrlInput").value.trim();
            document.getElementById("fmSelectBtn").disabled = !hasSelection;
        }

        // ========== YOUR AJAX IMAGE LOADING ==========
        function loadImages(page = 1, append = false) {
            currentPage = page;
            const grid = document.getElementById("fmImgGrid");

            if (!append) {
                grid.innerHTML =
                    '<div style="grid-column:1/-1;text-align:center;padding:30px;color:var(--text3);font-size:11px"><i class="fa fa-spinner fa-spin"></i> Loading...</div>';
            }

            // YOUR AJAX CALL - REPLACE BASE_URL with your endpoint
            fetch(`/backend/file-manager/images?page=${page}&limit=32`)
                .then((res) => res.json())
                .then((data) => {
                    fmImages = data.data || [];

                    // pagination
                    totalPages = data.next_page ? page + 1 : page;

                    if (fmImages.length === 0) {
                        grid.innerHTML = `
                            <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--text3);font-size:12px">
                                <i class="fa fa-images" style="font-size:32px;opacity:.3;display:block;margin-bottom:12px"></i>
                                No images found.<br>
                                Add some via drag & drop or upload.
                            </div>`;
                        return;
                    }

                    grid.innerHTML = fmImages
                        .map((img) => buildImageHtml(img))
                        .join("");

                    document.querySelectorAll(".fm-img-item").forEach((item) => {
                        item.addEventListener("click", function() {
                            selectFMImage(this.dataset.url, this);
                        });
                    });

                    updatePagination();
                })
                .catch((err) => {
                    console.error("Load images error:", err);

                    grid.innerHTML = `
            <div style="grid-column:1/-1;text-align:center;padding:30px;color:var(--accent2);font-size:11px">
                <i class="fa fa-exclamation-triangle"></i>
                Failed to load images.
            </div>
        `;
                });
        }

        function buildImageHtml(img) {
            return `
        <div class="fm-img-item" data-url="${img.url}">
            <img src="${img.url}" alt="">
        </div>`;
        }

        function updatePagination() {
            const pagination = document.getElementById("fmPagination");
            const prevBtn = document.getElementById("fmPrevBtn");
            const nextBtn = document.getElementById("fmNextBtn");
            const pageInfo = document.getElementById("fmPageInfo");

            pagination.style.display = totalPages > 1 ? "block" : "none";
            prevBtn.style.opacity = currentPage > 1 ? "1" : ".5";
            prevBtn.disabled = currentPage <= 1;
            nextBtn.style.opacity = currentPage < totalPages ? "1" : ".5";
            nextBtn.disabled = currentPage >= totalPages;
            pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        }

        // ========== YOUR UPLOAD LOGIC ==========
        function initDmUploader() {
            const dropArea = document.getElementById("fmDropArea");
            const fileInput = document.getElementById("fmFileInput");
            const filesList = document.getElementById("fmFilesList");

            // Drag & Drop
            ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ["dragenter", "dragover"].forEach((eventName) => {
                dropArea.addEventListener(
                    eventName,
                    () => dropArea.classList.add("dragover"),
                    false,
                );
            });

            ["dragleave", "drop"].forEach((eventName) => {
                dropArea.addEventListener(
                    eventName,
                    () => dropArea.classList.remove("dragover"),
                    false,
                );
            });

            dropArea.addEventListener("drop", handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            fileInput.addEventListener("change", function(e) {
                handleFiles(e.target.files);
                e.target.value = "";
            });

            function handleFiles(files) {
                Array.from(files).forEach(uploadFile);
            }

            function uploadFile(file) {
                if (!file.type.startsWith("image/")) return;

                const item = showUploadItem(file);
                const formData = new FormData();
                formData.append("file", file);
                formData.append("_token", "{{ csrf_token() }}");

                fetch("/backend/file-manager/upload", {
                        method: "POST",
                        body: formData,
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        if (data.location) {
                            item.classList.remove("uploading");
                            item.classList.add("success");
                            item.querySelector(".fstatus").textContent = "Done ✓";
                            loadImages(1, false); // Refresh gallery
                        } else {
                            throw new Error(data.error || "Upload failed");
                        }
                    })
                    .catch((err) => {
                        item.classList.remove("uploading");
                        item.classList.add("error");
                        item.querySelector(".fstatus").textContent = "Error ✗";
                    });
            }

            function showUploadItem(file) {
                const li = document.createElement("li");
                li.className = "fm-upload-item uploading";
                li.innerHTML = `
                    <span class="fname">${file.name}</span>
                    <span class="fstatus">Uploading...</span>
                    <div class="fm-prog-bar"><div class="fm-prog-fill" style="width:0%"></div></div>
                    <button onclick="this.parentElement.remove()" style="background:none;border:none;color:var(--text3);cursor:pointer;font-size:11px;padding:0"><i class="fa fa-xmark"></i></button>
                `;
                document.getElementById("fmFilesList").appendChild(li);
                return li;
            }
        }

        // ========== IMAGE PREVIEW HELPER (USED BY YOUR PROP PANELS) ==========
        function buildImagePreviewHtml(url) {
            return `<div class="image-preview-box"><img src="${url}" alt="Preview"><button class="remove-img-btn" onclick="this.parentElement.remove()">✕</button></div>`;
        }

        // ============================
        // TEMPLATES
        // ============================
        function buildHeroTemplate() {
            const sec = addSection(null, null, 1);
            sec.style.padding = "40px 20px";
            sec.style.background = "linear-gradient(135deg,#1a1d27,#22263a)";
            addWidget(sec.id, sec.cols[0].id, "heading", {
                text: "Build Something Amazing",
                sub: "The next-gen page builder",
                level: "h1",
            });
            addWidget(sec.id, sec.cols[0].id, "text", {
                content: "Start building beautiful pages with our intuitive drag & drop interface.",
            });
            addWidget(sec.id, sec.cols[0].id, "button", {
                label: "Get Started Free",
                href: "#",
                style: "solid",
            });
            return sec;
        }

        function buildFeaturesTemplate() {
            const sec = addSection(null, null, 3);
            sec.style.padding = "28px 14px";
            [0, 1, 2].forEach((idx) => {
                const icons = ["fa-rocket", "fa-shield-halved", "fa-users"];
                const titles = ["Lightning Fast", "Fort Knox Security", "24/7 Support"];
                const descs = [
                    "Optimized for peak performance.",
                    "Enterprise-grade protection.",
                    "Our team is always ready.",
                ];
                addWidget(sec.id, sec.cols[idx].id, "icon-card", {
                    icon: icons[idx],
                    title: titles[idx],
                    desc: descs[idx],
                });
            });
            return sec;
        }

        function buildTwoColTemplate() {
            const sec = addSection(null, null, 2, [50, 50]);
            sec.style.padding = "28px 14px";
            addWidget(sec.id, sec.cols[0].id, "heading", {
                text: "Our Story",
                sub: "Who we are",
                level: "h2",
            });
            addWidget(sec.id, sec.cols[0].id, "text", {
                content: "We are a passionate team dedicated to building the best tools.",
            });
            addWidget(sec.id, sec.cols[0].id, "button", {
                label: "Learn More",
                href: "#",
                style: "outline",
            });
            addWidget(sec.id, sec.cols[1].id, "image", {
                src: "https://picsum.photos/seed/story/600/400",
                alt: "Our story",
            });
            return sec;
        }

        function buildStatsTemplate() {
            const sec = addSection(null, null, 1);
            sec.style.padding = "28px 14px";
            addWidget(sec.id, sec.cols[0].id, "stats", {
                items: [{
                        num: "10,000+",
                        label: "Happy Customers",
                        icon: "fa fa-users"
                    },
                    {
                        num: "99.9%",
                        label: "Uptime",
                        icon: "fa fa-server"
                    },
                    {
                        num: "150+",
                        label: "Countries",
                        icon: "fa fa-earth-americas"
                    },
                    {
                        num: "5★",
                        label: "Rating",
                        icon: "fa fa-star"
                    },
                ],
            });
            return sec;
        }

        function buildTestimonialsTemplate() {
            const sec = addSection(null, null, 3);
            sec.style.padding = "28px 14px";
            [
                ["Absolutely incredible!", "Sarah Chen", "Product Lead"],
                ["Changed our workflow.", "Marcus Lee", "CTO"],
                ["Best tool ever.", "Priya Patel", "Designer"],
            ].forEach((q, i) =>
                addWidget(sec.id, sec.cols[i].id, "testimonial", {
                    quote: q[0],
                    author: q[1],
                    role: q[2],
                }),
            );
            return sec;
        }

        function buildCTATemplate() {
            const sec = addSection(null, null, 2, [60, 40]);
            sec.style.padding = "30px 18px";
            sec.style.background = "linear-gradient(135deg,#5b52f0,#3b3680)";
            sec.style.borderRadius = "10px";
            addWidget(sec.id, sec.cols[0].id, "heading", {
                text: "Ready to get started?",
                sub: "Join thousands of happy users today",
                level: "h2",
            });
            addWidget(sec.id, sec.cols[1].id, "button", {
                label: "Start for Free →",
                href: "#",
                style: "solid",
            });
            return sec;
        }



        // ============================
        // PANEL
        // ============================
        function switchTab(tab, el) {
            document
                .querySelectorAll(".panel-tab")
                .forEach((t) => t.classList.remove("active"));
            el.classList.add("active");
            ["elements", "templates", "layers", 'cust-templates'].forEach((t) => {
                document.getElementById(`tab-${t}`).style.display =
                    t === tab ? "" : "none";
            });
            if (tab === "layers") updateLayers();
        }

        function updateLayers() {
            const tree = document.getElementById("layers-tree");
            if (!tree) return;

            tree.innerHTML = sections.length === 0 ?
                '<div style="color:var(--text3);font-size:11px;padding:20px;text-align:center"><i class="fa fa-layer-group" style="font-size:24px;opacity:.3;display:block;margin-bottom:8px"></i>No elements yet</div>' :
                '';

            if (sections.length === 0) return;

            // Build the root sortable list
            const rootUl = buildLayerList(sections, 'root');
            tree.appendChild(rootUl);

            // Init sortable on all layer lists
            initLayerSortables(tree);
        }

        function buildLayerList(items, groupKey, depth = 0) {
            const ul = document.createElement('ul');
            ul.className = 'layer-list';
            ul.dataset.group = groupKey;
            ul.style.cssText = `list-style:none;margin:0;padding:0;`;

            items.forEach((node) => {
                ul.appendChild(buildLayerItem(node, depth));
            });

            return ul;
        }

        function buildLayerItem(node, depth = 0) {
            const li = document.createElement('li');
            li.className = 'layer-item';
            li.dataset.id = node.id;
            li.style.cssText = `user-select:none;`;

            const pad = 6 + depth * 12;

            // --- DIV NODE ---
            if (node.nodeType === 'div') {
                const row = document.createElement('div');
                row.className = 'layer-row';
                row.style.cssText = `
            display:flex;align-items:center;gap:5px;
            padding:4px 6px 4px ${pad}px;
            cursor:pointer;border-radius:3px;font-size:10px;
            background:var(--surface2);margin-bottom:2px;
        `;
                row.innerHTML = `
            <span class="layer-drag-handle" title="Drag">
                <i class="fa fa-grip-lines" style="color:var(--text3);font-size:9px;cursor:grab"></i>
            </span>
            <i class="fa fa-code" style="color:#f59e0b;font-size:9px"></i>
            <span style="flex:1">&lt;div${node.divClasses ? ' .' + node.divClasses.split(' ').join(' .') : ''}&gt;</span>
            <i class="fa fa-chevron-down layer-toggle" style="font-size:8px;cursor:pointer;transition:.2s"></i>
        `;
                row.addEventListener('click', (e) => {
                    if (e.target.closest('.layer-drag-handle')) return;
                    if (e.target.closest('.layer-toggle')) {
                        toggleLayerChildren(li);
                        return;
                    }
                    selectDiv(node.id);
                    highlightLayerItem(li);
                });

                li.appendChild(row);

                if (node.children && node.children.length > 0) {
                    const childUl = buildLayerList(node.children, 'div-' + node.id, depth + 1);
                    childUl.dataset.parentId = node.id;
                    childUl.dataset.parentType = 'div';
                    li.appendChild(childUl);
                } else {
                    // Empty drop zone
                    const emptyUl = document.createElement('ul');
                    emptyUl.className = 'layer-list layer-empty';
                    emptyUl.dataset.group = 'div-' + node.id;
                    emptyUl.dataset.parentId = node.id;
                    emptyUl.dataset.parentType = 'div';
                    emptyUl.style.cssText = `list-style:none;margin:0;padding:2px 6px 2px ${pad + 12}px;min-height:18px;`;
                    emptyUl.innerHTML = `<li style="color:var(--text3);font-size:9px;padding:2px 0">empty</li>`;
                    li.appendChild(emptyUl);
                }

                return li;
            }

            // --- SECTION / BS-ROW ---
            if (node.type === 'section' || node.type === 'bs-row') {
                const isBs = node.type === 'bs-row';
                const row = document.createElement('div');
                row.className = 'layer-row';
                row.style.cssText = `
            display:flex;align-items:center;gap:5px;
            padding:4px 6px 4px ${pad}px;
            cursor:pointer;border-radius:3px;font-size:10px;
            background:var(--surface2);margin-bottom:2px;
        `;
                row.innerHTML = `
            <span class="layer-drag-handle" title="Drag">
                <i class="fa fa-grip-lines" style="color:var(--text3);font-size:9px;cursor:grab"></i>
            </span>
            <i class="fa ${isBs ? 'fa-grip' : 'fa-table-columns'}" style="color:var(--accent);font-size:9px"></i>
            <span style="flex:1">${isBs ? 'BS Row' : 'Section'} (${node.cols.length} cols)</span>
            <i class="fa fa-chevron-down layer-toggle" style="font-size:8px;cursor:pointer;transition:.2s"></i>
        `;
                row.addEventListener('click', (e) => {
                    if (e.target.closest('.layer-drag-handle')) return;
                    if (e.target.closest('.layer-toggle')) {
                        toggleLayerChildren(li);
                        return;
                    }
                    selectSection(node.id);
                    highlightLayerItem(li);
                });

                li.appendChild(row);

                // Add col children
                if (node.cols) {
                    node.cols.forEach((col) => {
                        if (col.widgets && col.widgets.length > 0) {
                            const colUl = buildLayerList(col.widgets, 'col-' + col.id, depth + 1);
                            colUl.dataset.parentId = col.id;
                            colUl.dataset.parentType = 'col';

                            // Col label
                            const colLabel = document.createElement('div');
                            colLabel.style.cssText = `
                        padding:2px 6px 2px ${pad + 12}px;
                        font-size:9px;color:var(--text3);margin-bottom:1px;
                    `;
                            colLabel.innerHTML =
                                `<i class="fa fa-columns" style="font-size:8px"></i> col: ${col.id.slice(-4)}`;
                            li.appendChild(colLabel);
                            li.appendChild(colUl);
                        } else {
                            const colLabel = document.createElement('div');
                            colLabel.style.cssText = `
                        padding:2px 6px 2px ${pad + 12}px;
                        font-size:9px;color:var(--text3);margin-bottom:1px;
                    `;
                            colLabel.innerHTML =
                                `<i class="fa fa-columns" style="font-size:8px"></i> col: ${col.id.slice(-4)} <span style="opacity:.5">(empty)</span>`;

                            // Empty col drop zone
                            const emptyUl = document.createElement('ul');
                            emptyUl.className = 'layer-list layer-empty';
                            emptyUl.dataset.group = 'col-' + col.id;
                            emptyUl.dataset.parentId = col.id;
                            emptyUl.dataset.parentType = 'col';
                            emptyUl.style.cssText =
                                `list-style:none;margin:0;padding:2px 6px 2px ${pad + 12}px;min-height:18px;`;
                            emptyUl.innerHTML =
                                `<li style="color:var(--text3);font-size:9px;padding:2px 0">empty</li>`;

                            li.appendChild(colLabel);
                            li.appendChild(emptyUl);
                        }
                    });
                }

                return li;
            }

            // --- REGULAR WIDGET ---
            const comp = ALL_COMPONENTS.find((c) => c.type === node.type);
            const row = document.createElement('div');
            row.className = 'layer-row';
            row.style.cssText = `
        display:flex;align-items:center;gap:5px;
        padding:3px 6px 3px ${pad}px;
        cursor:pointer;border-radius:3px;font-size:10px;margin-bottom:1px;
    `;
            row.innerHTML = `
        <span class="layer-drag-handle" title="Drag">
            <i class="fa fa-grip-lines" style="color:var(--text3);font-size:9px;cursor:grab"></i>
        </span>
        <i class="fa ${comp ? comp.icon : 'fa-puzzle-piece'}" style="color:var(--text3);font-size:9px"></i>
        <span style="color:var(--text2);flex:1">${comp ? comp.label : node.type}</span>
    `;
            row.addEventListener('click', (e) => {
                if (e.target.closest('.layer-drag-handle')) return;
                selectWidget(node.id);
                highlightLayerItem(li);
            });

            li.appendChild(row);
            return li;
        }

        function toggleLayerChildren(li) {
            const childLists = li.querySelectorAll(':scope > ul, :scope > div + ul');
            const toggle = li.querySelector('.layer-toggle');
            const isCollapsed = li.dataset.collapsed === '1';

            if (isCollapsed) {
                li.dataset.collapsed = '0';
                childLists.forEach(el => el.style.display = '');
                if (toggle) toggle.style.transform = '';
            } else {
                li.dataset.collapsed = '1';
                childLists.forEach(el => el.style.display = 'none');
                if (toggle) toggle.style.transform = 'rotate(-90deg)';
            }
        }

        function highlightLayerItem(li) {
            document.querySelectorAll('.layer-item .layer-row.active-layer')
                .forEach(el => el.classList.remove('active-layer'));
            const row = li.querySelector('.layer-row');
            if (row) {
                row.classList.add('active-layer');
                row.style.background = 'var(--surface3)';
            }
        }

        function initLayerSortables(container) {
            container.querySelectorAll('.layer-list').forEach((ul) => {
                if (ul.dataset.sortableLayerInit) return;
                ul.dataset.sortableLayerInit = '1';

                Sortable.create(ul, {
                    group: 'layers',
                    handle: '.layer-drag-handle',
                    animation: 150,
                    ghostClass: 'layer-ghost',
                    dragClass: 'layer-dragging',

                    onEnd(evt) {
                        const draggedId = evt.item.dataset.id;
                        const fromEl = evt.from;
                        const toEl = evt.to;
                        const newIndex = evt.newIndex;

                        if (!draggedId) return;

                        // Remove from source data array
                        const draggedNode = removeNodeFromTree(draggedId);
                        if (!draggedNode) {
                            renderCanvas();
                            updateLayers();
                            return;
                        }

                        // Find target data array
                        const targetArray = getLayerTargetArray(toEl);
                        if (!targetArray) {
                            renderCanvas();
                            updateLayers();
                            return;
                        }

                        // Calculate correct insert index
                        // (skip non-li or empty placeholder items)
                        const realItems = Array.from(toEl.children)
                            .filter(el => el.classList.contains('layer-item'));
                        const clampedIndex = Math.min(newIndex, targetArray.length);

                        targetArray.splice(clampedIndex, 0, draggedNode);

                        saveHistory();
                        renderCanvas();
                        updateLayers();
                    }
                });
            });
        }

        function getLayerTargetArray(ul) {
            const parentType = ul.dataset.parentType;
            const parentId = ul.dataset.parentId;

            // Root list
            if (!parentType || ul.dataset.group === 'root') {
                return sections;
            }

            // Col list
            if (parentType === 'col') {
                return findColWidgets(parentId);
            }

            // Div list
            if (parentType === 'div') {
                const div = findDivWrapper(parentId);
                return div ? div.children : null;
            }

            return null;
        }

        function renderNode(node, depth = 0, parentList = sections) {
            const pad = 8 + depth * 14;

            // Div wrapper
            if (node.nodeType === "div") {
                let h =
                    `<div style="padding:3px 6px 3px ${pad}px;cursor:pointer;border-radius:3px;display:flex;align-items:center;gap:5px;font-size:10px;background:var(--surface2);margin-bottom:2px" onmouseover="this.style.background='var(--surface3)'" onmouseout="this.style.background='var(--surface2)'" onclick="selectDiv('${node.id}')"><i class="fa fa-code" style="color:#f59e0b;font-size:9px"></i><span>&lt;div${node.divClasses ? " ." + node.divClasses.split(" ").join(" .") : ""}&gt;</span></div>`;
                if (node.children && node.children.length > 0) {
                    node.children.forEach(
                        (ch) => (h += renderNode(ch, depth + 1, node.children)),
                    );
                }
                return h;
            }

            // Section/BS Row
            if (node.type === "section" || node.type === "bs-row") {
                let h =
                    `<div style="padding:3px 6px 3px ${pad}px;cursor:pointer;border-radius:3px;display:flex;align-items:center;gap:5px;font-size:10px;background:var(--surface2);margin-bottom:2px" onmouseover="this.style.background='var(--surface3)'" onmouseout="this.style.background='var(--surface2)'" onclick="selectSection('${node.id}')"><i class="fa ${node.type === "bs-row" ? "fa-grip" : "fa-table-columns"}" style="color:var(--accent);font-size:9px"></i><span>${node.type === "bs-row" ? "BS Row" : "Section"} (${node.cols.length} cols)</span></div>`;
                if (node.cols) {
                    node.cols.forEach((col) => {
                        col.widgets.forEach(
                            (w) => (h += renderNode(w, depth + 1, col.widgets)),
                        );
                    });
                }
                return h;
            }

            // Regular widget
            const comp = ALL_COMPONENTS.find((c) => c.type === node.type);
            return `<div style="padding:2px 6px 2px ${pad}px;cursor:pointer;border-radius:3px;display:flex;align-items:center;gap:5px;font-size:10px;margin-bottom:1px" onmouseover="this.style.background='var(--surface3)'" onmouseout="this.style.background=''" onclick="selectWidget('${node.id}')"><i class="fa ${comp ? comp.icon : "fa-puzzle-piece"}" style="color:var(--text3);font-size:9px"></i><span style="color:var(--text2)">${comp ? comp.label : node.type}</span></div>`;
        }

        function renderComponents() {
            const groups = [{
                    key: "struct",
                    gridId: "struct-grid",
                },
                {
                    key: "content",
                    gridId: "content-grid",
                },
                {
                    key: "media",
                    gridId: "media-grid",
                },
                {
                    key: "advanced",
                    gridId: "advanced-grid",
                },
            ];
            groups.forEach(({
                key,
                gridId
            }) => {
                const grid = document.getElementById(gridId);
                if (!grid) return;
                (COMPONENTS[key] || []).forEach((comp) => {
                    const item = document.createElement("div");
                    item.className = "comp-item";
                    item.draggable = true;
                    item.innerHTML = `<i class="fa ${comp.icon}"></i><span>${comp.label}</span>`;
                    item.addEventListener("dragstart", (e) => {
                        activeDragType = comp.type;
                        item.classList.add("dragging-from-panel");
                    });
                    item.addEventListener("dragend", () => {
                        item.classList.remove("dragging-from-panel");
                        setTimeout(() => (activeDragType = null), 100);
                    });
                    item.addEventListener("click", () => {
                        if (comp.type === "section") {
                            addSection();
                            return;
                        }
                        if (comp.type === "bs-row") {
                            addBsRowSection();
                            return;
                        }
                        if (comp.type === "div-wrapper") {
                            addDivWrapper();
                            return;
                        }
                        if (sections.length === 0) {
                            const s = addSection();
                            addWidget(s.id, s.cols[0].id, comp.type);
                        } else {
                            const s = sections[sections.length - 1];
                            addWidget(s.id, s.cols[0].id, comp.type);
                        }
                    });
                    grid.appendChild(item);
                });
            });
        }

        // function renderTemplatePanelList() {
        //     const list = document.getElementById("tpl-list");
        //     SECTION_TEMPLATES.forEach((tpl) => {
        //         const item = document.createElement("div");
        //         item.className = "tpl-item";
        //         item.innerHTML =
        //             `<i class="fa ${tpl.icon}"></i><div class="tpl-item-info"><h4>${tpl.label}</h4><p>${tpl.desc}</p></div><span class="tpl-badge">USE</span>`;
        //         item.addEventListener("click", () => {
        //             saveHistory();
        //             tpl.build();
        //         });
        //         list.appendChild(item);
        //     });
        // }
        function renderTemplatePanelList() {
            const list = document.getElementById("tpl-list");
            list.innerHTML = "";
            SECTION_TEMPLATES.forEach((tpl) => {
                const item = document.createElement("div");
                item.className = "tpl-item";
                item.draggable = true;
                item.innerHTML =
                    `<i class="fa ${tpl.icon}"></i><div class="tpl-item-info"><h4>${tpl.label}</h4><p>${tpl.desc}</p></div><span class="tpl-badge">USE</span>`;

                item.addEventListener("dragstart", (e) => {
                    activeDragType = "__template__";
                    window._pendingTemplate = {
                        kind: "builtin",
                        tpl
                    };
                    e.dataTransfer.effectAllowed = "copy";
                });
                item.addEventListener("dragend", () => {
                    setTimeout(() => {
                        activeDragType = null;
                        window._pendingTemplate = null;
                    }, 100);
                });
                item.addEventListener("click", () => {
                    saveHistory();
                    tpl.build();
                });
                list.appendChild(item);
            });
        }

        function openTemplateModal() {
            const grid = document.getElementById("tplModalGrid");
            grid.innerHTML = "";
            SECTION_TEMPLATES.forEach((tpl) => {
                const card = document.createElement("div");
                card.className = "modal-tpl-card";
                card.innerHTML =
                    `<div class="tpl-preview"><i class="fa ${tpl.icon}"></i></div><div class="tpl-meta"><h4>${tpl.label}</h4><p>${tpl.desc}</p></div>`;
                card.addEventListener("click", () => {
                    saveHistory();
                    tpl.build();
                    closeTplModal();
                });
                grid.appendChild(card);
            });
            document.getElementById("tplModal").style.display = "flex";
        }

        function closeTplModal() {
            document.getElementById("tplModal").style.display = "none";
        }

        // ROOT DROP
        function initRootDrop() {
            const rd = document.getElementById("root-drop");
            rd.addEventListener("dragover", (e) => {
                e.preventDefault();
                rd.classList.add("drag-over");
            });
            rd.addEventListener("dragleave", (e) => {
                if (!rd.contains(e.relatedTarget)) rd.classList.remove("drag-over");
            });
            rd.addEventListener("drop", (e) => {
                e.preventDefault();
                rd.classList.remove("drag-over");
                if (activeDragType) {
                    if (activeDragType === "section") addSection();
                    else if (activeDragType === "bs-row") addBsRowSection();
                    else if (activeDragType === "div-wrapper") addDivWrapper();
                    else if (activeDragType === "__template__") {
                        applyPendingTemplate(sections); // top-level drop
                    } else {
                        const s = addSection();
                        addWidget(s.id, s.cols[0].id, activeDragType);
                    }
                    activeDragType = null;
                }
            });
        }

        function setDevice(mode, btn) {
            document
                .querySelectorAll(".device-btn")
                .forEach((b) => b.classList.remove("active"));
            btn.classList.add("active");
            document.getElementById("canvas-area").className = "canvas-area " + mode;
        }

        function previewPage() {
            const w = window.open("", "_blank");

            function renderNode(node) {
                if (node.nodeType === "div") {
                    const s = node.inlineStyles || {};
                    const pad = buildSpacing(s.pt, s.pr, s.pb, s.pl, "");
                    const mar = buildSpacing(s.mt, s.mr, s.mb, s.ml, "");
                    const style =
                        `${s.background ? "background:" + s.background + ";" : ""}${pad ? "padding:" + pad + ";" : ""}${mar ? "margin:" + mar + ";" : ""}${s.border ? "border:" + s.border + ";" : ""}${s.borderRadius ? "border-radius:" + s.borderRadius + ";" : ""}${s.display ? "display:" + s.display + ";" : ""}${s.flexDirection ? "flex-direction:" + s.flexDirection + ";" : ""}${s.alignItems ? "align-items:" + s.alignItems + ";" : ""}${s.justifyContent ? "justify-content:" + s.justifyContent + ";" : ""}${s.gap ? "gap:" + s.gap + ";" : ""}${s.color ? "color:" + s.color + ";" : ""}${s.fontSize ? "font-size:" + s.fontSize + ";" : ""}${s.bgImage ? "background-image:url(" + s.bgImage + ");background-size:" + (s.bgSize || "cover") + ";background-position:" + (s.bgPosition || "center") + ";" : ""}${node.divStyle || ""}`;
                    let h =
                        `<div class="${node.divClasses || ""}" style="${style}">${(node.children || []).map((c) => renderNode(c)).join("")}</div>`;
                    return h;
                }
                if (node.type === "section" || node.type === "bs-row") {
                    const sty = node.style || {};
                    const pad = buildSpacing(
                        sty.pt,
                        sty.pr,
                        sty.pb,
                        sty.pl,
                        sty.padding,
                    );
                    const mar = buildSpacing(
                        sty.mt,
                        sty.mr,
                        sty.mb,
                        sty.ml,
                        sty.margin,
                    );
                    const bg = sty.bgImage ?
                        `background-image:url(${sty.bgImage});background-size:${sty.bgSize || "cover"};background-position:${sty.bgPosition || "center"};` :
                        "";
                    if (node.type === "bs-row") {
                        return `<div class="row ${sty.classes || ""}" style="${sty.background ? "background:" + sty.background + ";" : ""}${bg}${pad ? "padding:" + pad + ";" : ""}${mar ? "margin:" + mar + ";" : ""}">${node.cols.map((col) => `<div class="${col.bsCol || "col-md-6"}">${col.widgets.map((w) => renderNode(w)).join("")}</div>`).join("")}</div>`;
                    }
                    return `<div class="${sty.classes || ""}" style="display:flex;flex-wrap:wrap;gap:${sty.gap || "0"};flex-direction:${sty.flexDirection || "row"};align-items:${sty.alignItems || "stretch"};justify-content:${sty.justifyContent || "flex-start"};${sty.background ? "background:" + sty.background + ";" : ""}${bg}${pad ? "padding:" + pad + ";" : ""}${mar ? "margin:" + mar + ";" : ""}${sty.border ? "border:" + sty.border + ";" : ""}${sty.borderRadius ? "border-radius:" + sty.borderRadius + ";" : ""}${sty.minHeight ? "min-height:" + sty.minHeight + ";" : ""}">${node.cols.map((col) => `<div style="flex:0 0 calc(${col.width || Math.floor(100 / node.cols.length)}% - 3px)">${col.widgets.map((w) => renderNode(w)).join("")}</div>`).join("")}</div>`;
                }
                return `<div>${renderWidgetContent(node)}</div>`;
            }
            let html =
                '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Preview</title><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"><style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:sans-serif}</style></head><body>';
            sections.forEach((s) => (html += renderNode(s)));
            html += "</body></html>";
            w.document.write(html);
            w.document.close();
        }

        async function saveData() {
            const json = JSON.stringify(sections, null, 2);
            console.log("SAVE:", json);
            Swal.fire({
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            // const blob = new Blob([json], {
            //     type: "application/json",
            // });
            // const a = document.createElement("a");
            // a.href = URL.createObjectURL(blob);
            // a.download = "page-data.json";
            // a.click();
            const payload = {
                page_id: document.getElementById('hidden_page_id').value,
                sections: json
            };

            try {

                const response = await fetch(
                    '/backend/pagebuilder/page/store', {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name=\"csrf-token\"]')
                                .getAttribute('content')
                        },

                        body: JSON.stringify(payload)
                    }
                );

                const data = await response.json();

                if (data.status) {
                    Swal.close();
                    loadTemplates();
                }

            } catch (e) {

                console.error(e);

                alert('Failed to save template');
            }

        }

        function previewData() {
            const json = JSON.stringify(sections);
            document.getElementById("previewJson").value = json;
            document.getElementById("previewForm").submit();
        }

        function undoLast() {
            if (history.length < 2) return;
            history.pop();
            sections = JSON.parse(history[history.length - 1]);
            renderCanvas();
            updateLayers();
        }

        // ============================
        // INIT
        // ============================
        renderComponents();
        renderTemplatePanelList();
        initRootDrop();
        sanitizeDuplicateIds();
        history.push(JSON.stringify(sections));
        saveHistory();
        renderCanvas();
        updateLayers();


        // ============================
        // SORTABLEJS ELEMENTOR SUPPORT
        // ============================

        function initSortableSystem() {

            document.querySelectorAll('.section-col, .pb-bs-col, .div-inner, #canvas')
                .forEach(container => {

                    if (container.dataset.sortableInit) return;
                    container.dataset.sortableInit = '1';

                    Sortable.create(container, {

                        group: {
                            name: 'pagebuilder',
                            pull: true,
                            put: true
                        },

                        animation: 200,
                        fallbackOnBody: true,
                        swapThreshold: 0.65,

                        ghostClass: 'sortable-ghost',
                        dragClass: 'sortable-drag',

                        draggable: '.sortable-item',

                        onEnd(evt) {

                            const draggedId = evt.item.id;

                            if (!draggedId) return;

                            const draggedNode = removeNodeFromTree(draggedId);

                            if (!draggedNode) {
                                renderCanvas();
                                return;
                            }

                            const targetContainer = getContainerArray(evt.to);

                            if (!targetContainer) {
                                renderCanvas();
                                return;
                            }

                            targetContainer.splice(evt.newIndex, 0, draggedNode);

                            saveHistory();

                            renderCanvas();
                            updateLayers();
                        }
                    });
                });
        }

        function removeNodeFromTree(id, list = sections) {

            for (let i = 0; i < list.length; i++) {

                const item = list[i];

                if (item.id === id) {
                    return list.splice(i, 1)[0];
                }

                // section cols
                if (item.cols) {

                    for (const col of item.cols) {

                        const found = removeNodeFromTree(id, col.widgets);

                        if (found) return found;
                    }
                }

                // div children
                if (item.children) {

                    const found = removeNodeFromTree(id, item.children);

                    if (found) return found;
                }
            }

            return null;
        }

        function getContainerArray(el) {

            // canvas root
            if (el.id === 'canvas') {
                return sections;
            }

            // div inner container
            if (el.classList.contains('div-inner')) {
                const divId = el.id.replace('div-inner-', '');
                const div = findDivWrapper(divId);
                if (div) return div.children;
            }

            // section col (custom flex layout)
            if (el.classList.contains('section-col')) {
                const colId = el.id;
                return findColWidgets(colId);
            }

            // BS Row col (.pb-bs-col) — id is set directly on the colEl
            if (el.classList.contains('pb-bs-col')) {
                const colId = el.id;
                return findColWidgets(colId);
            }

            return null;
        }

        function findColWidgets(colId, list = sections) {

            for (const sec of list) {

                if (sec.cols) {

                    for (const col of sec.cols) {

                        if (col.id === colId) {
                            return col.widgets;
                        }

                        for (const w of col.widgets) {

                            const found = findColWidgets(colId, [w]);

                            if (found) return found;
                        }
                    }
                }

                if (sec.children) {

                    const found = findColWidgets(colId, sec.children);

                    if (found) return found;
                }
            }

            return null;
        }

        function getNodeById(id, list = sections) {

            for (const item of list) {

                if (item.id === id) {
                    return item;
                }

                // section cols
                if (item.cols) {

                    for (const col of item.cols) {

                        for (const w of col.widgets) {

                            const found = getNodeById(id, [w]);

                            if (found) return found;
                        }
                    }
                }

                // div children
                if (item.children) {

                    const found = getNodeById(id, item.children);

                    if (found) return found;
                }
            }

            return null;
        }

        async function saveTemplate(id) {

            const node = getNodeById(id);

            if (!node) {

                Swal.fire({
                    icon: 'error',
                    title: 'Template Not Found',
                    text: 'Unable to locate the selected template.'
                });

                return;
            }

            // TEMPLATE NAME PROMPT
            const {
                value: name
            } = await Swal.fire({
                title: 'Save Template',
                input: 'text',
                inputLabel: 'Template Name',
                inputPlaceholder: 'Enter template name',
                showCancelButton: true,
                confirmButtonText: 'Save Template',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {

                    if (!value) {
                        return 'Template name is required';
                    }
                }
            });

            if (!name) return;

            const payload = {
                name: name,
                type: 'section',
                content: JSON.stringify(node)
            };

            try {

                // LOADING
                Swal.fire({
                    title: 'Saving Template...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch(
                    '/backend/pagebuilder/templates/save', {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },

                        body: JSON.stringify(payload)
                    }
                );

                const data = await response.json();

                Swal.close();

                if (data.status) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Template Saved',
                        text: 'Your template has been saved successfully.',
                        timer: 1800,
                        showConfirmButton: false
                    });

                    loadTemplates();

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Save Failed',
                        text: data.message || 'Unable to save template.'
                    });
                }

            } catch (e) {

                console.error(e);

                Swal.fire({
                    icon: 'error',
                    title: 'Request Failed',
                    text: 'Something went wrong while saving the template.'
                });
            }
        }
        let dynamicTemplates = [];

        async function loadTemplates() {

            try {

                const response = await fetch(
                    '/backend/pagebuilder/templates/list'
                );

                const data = await response.json();

                dynamicTemplates = data.templates;

                renderTemplates();

            } catch (e) {

                console.error(e);
            }
        }


        function renderTemplates() {
            const container = document.getElementById('tab-cust-templates');
            container.innerHTML = '<div class="comp-group-label">Saved Templates</div>';

            dynamicTemplates.forEach(template => {
                const item = document.createElement('div');
                item.className = 'tpl-item';
                item.draggable = true;
                item.innerHTML = `
            <i class="fa fa-bookmark"></i>
            <div class="tpl-item-info">
                <h4>${template.name}</h4>
                <p>Saved Template</p>
            </div>
            <span class="tpl-delete" onclick='event.stopPropagation(); deleteTemplate(${template.id});'>
                <i class="fa-solid fa-trash"></i>
            </span>`;

                item.addEventListener('dragstart', (e) => {
                    activeDragType = "__template__";
                    window._pendingTemplate = {
                        kind: "saved",
                        template
                    };
                    e.dataTransfer.effectAllowed = "copy";
                });
                item.addEventListener('dragend', () => {
                    setTimeout(() => {
                        activeDragType = null;
                        window._pendingTemplate = null;
                    }, 100);
                });
                item.addEventListener('click', () => {
                    insertTemplate(template.content);
                });

                container.appendChild(item);
            });
        }
        async function deleteTemplate(id) {

            // CONFIRM DELETE
            const result = await Swal.fire({
                title: 'Delete Template?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33'
            });

            if (!result.isConfirmed) {
                return;
            }

            const payload = {
                template_id: id
            };

            try {

                // LOADING
                Swal.fire({
                    title: 'Deleting Template...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch(
                    '/backend/pagebuilder/templates/delete', {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },

                        body: JSON.stringify(payload)
                    }
                );

                const data = await response.json();

                Swal.close();

                if (data.status) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted',
                        text: 'Template deleted successfully.',
                        timer: 1800,
                        showConfirmButton: false
                    });

                    loadTemplates();

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Delete Failed',
                        text: data.message || 'Unable to delete template.'
                    });
                }

            } catch (e) {

                console.error(e);

                Swal.fire({
                    icon: 'error',
                    title: 'Request Failed',
                    text: 'Something went wrong while deleting the template.'
                });
            }
        }

        function insertTemplate(content, targetSections = null) {
            let data;

            if (typeof content === 'string') {
                try {
                    data = JSON.parse(content);
                } catch (e) {
                    console.error('Invalid template JSON', e);
                    return;
                }
            } else {
                data = content;
            }

            // unwrap if backend wraps in { content: ... }
            if (data && data.content && !data.type && !data.nodeType) {
                data = typeof data.content === 'string' ?
                    JSON.parse(data.content) :
                    data.content;
            }

            const clone = JSON.parse(JSON.stringify(data));
            assignNewIds(clone);

            const list = targetSections || sections;
            list.push(clone);

            saveHistory();
            renderCanvas();
            updateLayers();
        }

        function applyPendingTemplate(targetList) {
            if (!window._pendingTemplate) return;

            const pending = window._pendingTemplate;

            if (pending.kind === "builtin") {
                // builtin templates call their own build() which always appends to sections[]
                // so we just call it — it already uses addSection internally
                saveHistory();
                pending.tpl.build();
            } else if (pending.kind === "saved") {
                insertTemplate(pending.template.content, targetList);
            }

            window._pendingTemplate = null;
            activeDragType = null;
        }

        document.addEventListener('keydown', function(e) {
            const isCtrlZ = (e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'z';
            if (!isCtrlZ) return;

            const active = document.activeElement;
            const isTyping = active && (
                active.tagName === 'INPUT' ||
                active.tagName === 'TEXTAREA' ||
                active.isContentEditable
            );

            if (isTyping) {
                // Let the browser handle native undo inside inputs/textareas
                return;
            }

            // Canvas / anywhere else = our custom undo
            e.preventDefault();
            undoLast();
        });
        loadTemplates();
        let _activeFocusedLayerRow = null;
        let _activeFocusedCanvasEl = null;
        let _layerFocusTimer = null;
        let _canvasFocusTimer = null;

        function clearLayerFocus() {
            if (_activeFocusedLayerRow) {
                _activeFocusedLayerRow.style.outline = '';
                _activeFocusedLayerRow.style.background = '';
                _activeFocusedLayerRow = null;
            }
            clearTimeout(_layerFocusTimer);
        }

        function clearCanvasFocus() {
            if (_activeFocusedCanvasEl) {
                _activeFocusedCanvasEl.style.outline = '';
                _activeFocusedCanvasEl.style.boxShadow = '';
                _activeFocusedCanvasEl = null;
            }
            clearTimeout(_canvasFocusTimer);
        }

        function syncLayerFocus(id) {
            requestAnimationFrame(() => {
                clearLayerFocus();

                const item = document.querySelector('.layer-item[data-id="' + id + '"]');
                if (!item) return;

                // Expand any collapsed ancestors
                let ancestor = item.parentElement;
                while (ancestor && ancestor.id !== 'layers-tree') {
                    if (ancestor.tagName === 'LI' && ancestor.dataset.collapsed === '1') {
                        toggleLayerChildren(ancestor);
                    }
                    ancestor = ancestor.parentElement;
                }

                // Scroll layer panel to this item
                const layersContainer = document.querySelector('.layers-container');
                if (layersContainer) {
                    const containerRect = layersContainer.getBoundingClientRect();
                    const itemRect = item.getBoundingClientRect();
                    const scrollTop = layersContainer.scrollTop + (itemRect.top - containerRect.top) - (
                        containerRect.height / 2) + (itemRect.height / 2);
                    layersContainer.scrollTo({
                        top: scrollTop,
                        behavior: 'smooth'
                    });
                }

                const row = item.querySelector('.layer-row');
                if (!row) return;

                // Apply focus highlight
                row.style.outline = '2px solid var(--accent)';
                row.style.outlineOffset = '-2px';
                row.style.background = 'var(--surface3)';
                _activeFocusedLayerRow = row;

                // Auto-remove after 2s
                clearTimeout(_layerFocusTimer);
                _layerFocusTimer = setTimeout(() => {
                    if (_activeFocusedLayerRow === row) {
                        row.style.outline = '';
                        row.style.background = '';
                        _activeFocusedLayerRow = null;
                    }
                }, 2000);
            });
        }

        function syncCanvasFocus(id) {
            clearCanvasFocus();

            const el = document.getElementById(id);
            if (!el) return;

            // Scroll canvas-wrapper to center the element
            const canvasWrapper = document.querySelector('.canvas-wrapper');
            if (canvasWrapper) {
                const wrapperRect = canvasWrapper.getBoundingClientRect();
                const elRect = el.getBoundingClientRect();
                const scrollTop = canvasWrapper.scrollTop + (elRect.top - wrapperRect.top) - (wrapperRect.height / 2) + (
                    elRect.height / 2);
                canvasWrapper.scrollTo({
                    top: scrollTop,
                    behavior: 'smooth'
                });
            }

            // Small delay so scroll starts before highlight appears
            setTimeout(() => {
                // Re-fetch el in case DOM changed
                const target = document.getElementById(id);
                if (!target) return;

                target.style.outline = '2px solid var(--accent)';
                target.style.outlineOffset = '-3px';
                target.style.boxShadow = '0 0 0 5px rgba(91,82,240,0.18)';
                _activeFocusedCanvasEl = target;

                clearTimeout(_canvasFocusTimer);
                _canvasFocusTimer = setTimeout(() => {
                    if (_activeFocusedCanvasEl === target) {
                        target.style.outline = '';
                        target.style.boxShadow = '';
                        _activeFocusedCanvasEl = null;
                    }
                }, 2000);
            }, 100);
        }

        // Patch canvas selectors to also sync layer panel
        const _origSelectSection = selectSection;
        selectSection = function(id) {
            _origSelectSection(id);
            syncLayerFocus(id);
        };

        const _origSelectWidget = selectWidget;
        selectWidget = function(id) {
            _origSelectWidget(id);
            syncLayerFocus(id);
        };

        const _origSelectDiv = selectDiv;
        selectDiv = function(id) {
            _origSelectDiv(id);
            syncLayerFocus(id);
        };
    </script>
</body>

</html>
