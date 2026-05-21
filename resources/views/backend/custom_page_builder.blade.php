<x-app :show_side_bar="false">

    <h2 class="sr-only">Page builder with custom theme section widget</h2>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="side-component-section">
                        <div class="side-header">
                            <i class="ti ti-menu-2"></i>
                            <span>Page Builder</span>
                        </div>
                        <div class="comp-container" id="comp-container"></div>
                    </div>
                </div>
                <div class="col-md-9" style="display:flex;flex-direction:column;gap:10px">
                    <div id="canvas-wrapper">
                        <div class="canvas-area" id="canvas"></div>
                        <div class="page-drag-drop" id="root-drop" style="margin-top:10px">
                            <span>Drag widget here to add a new section</span>
                        </div>
                        <button class="add-section-btn" onclick="addSection()"><i class="ti ti-plus"></i> Add
                            Section</button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" id="btnSave">Save</button>
            </div>
        </div>
    </div>

    <div class="prop-panel" id="propPanel">
        <div class="prop-header">
            <i class="ti ti-settings" style="color:#f89507"></i>
            <span id="propTitle">Properties</span>
            <button onclick="closeProp()"><i class="ti ti-x"></i></button>
        </div>
        <div class="prop-body" id="propBody"></div>
    </div>
    @push('scripts')
        <script>
            const DEFAULT_THEME_PROPS = {
                title: 'Why Choose Us',
                subtitle: 'Our Key Features',
                desc: 'We deliver exceptional results with a team dedicated to quality, innovation, and your success.',
                image: 'https://picsum.photos/seed/theme/400/260',
                btnText: 'Get Started',
                btnUrl: '#',
                cards: [{
                        icon: 'ti-rocket',
                        text: 'Fast Delivery',
                        desc: 'Ship products at lightning speed.'
                    },
                    {
                        icon: 'ti-shield',
                        text: 'Secure & Safe',
                        desc: 'Enterprise-grade security always.'
                    },
                    {
                        icon: 'ti-users',
                        text: '24/7 Support',
                        desc: 'Our team is always here for you.'
                    },
                    {
                        icon: 'ti-trending-up',
                        text: 'Growth Focus',
                        desc: 'Data-driven strategies that scale.'
                    },
                ]
            };

            const COMPONENTS = [{
                    type: 'theme-section',
                    icon: 'ti-layout-navbar',
                    label: 'Theme Section',
                    props: JSON.parse(JSON.stringify(DEFAULT_THEME_PROPS)),
                    custom: true
                },
                {
                    type: 'heading',
                    icon: 'ti-heading',
                    label: 'Heading',
                    props: {
                        text: 'Your Heading',
                        sub: 'Subtitle',
                        level: 'h2'
                    }
                },
                {
                    type: 'text',
                    icon: 'ti-align-left',
                    label: 'Text Block',
                    props: {
                        content: 'Lorem ipsum dolor sit amet consectetur.'
                    }
                },
                {
                    type: 'button',
                    icon: 'ti-pointer',
                    label: 'Button',
                    props: {
                        label: 'Click Me',
                        href: '#',
                        style: 'solid'
                    }
                },
                {
                    type: 'image',
                    icon: 'ti-photo',
                    label: 'Image',
                    props: {
                        src: 'https://picsum.photos/seed/pb/600/300',
                        alt: 'Image'
                    }
                },
                {
                    type: 'card-img',
                    icon: 'ti-layout-cards',
                    label: 'Image Card',
                    props: {
                        img: 'https://picsum.photos/seed/card/400/200',
                        title: 'Card Title',
                        desc: 'A short description.'
                    }
                },
                {
                    type: 'icon-card',
                    icon: 'ti-star',
                    label: 'Icon Card',
                    props: {
                        icon: 'ti-rocket',
                        title: 'Feature',
                        desc: 'Brief feature desc.'
                    }
                },
                {
                    type: 'divider',
                    icon: 'ti-minus',
                    label: 'Divider',
                    props: {}
                },
                {
                    type: 'badges',
                    icon: 'ti-tag',
                    label: 'Badge List',
                    props: {
                        items: 'Design,Development,Marketing'
                    }
                },
                {
                    type: 'stats',
                    icon: 'ti-chart-bar',
                    label: 'Stats',
                    props: {
                        items: '1,000+|Users,98%|Satisfaction,50+|Projects'
                    }
                },
                {
                    type: 'section',
                    icon: 'ti-layout-rows',
                    label: 'Section',
                    props: {}
                },
            ];

            let sections = [];
            let dragData = null;
            let activePanelType = null;
            let idCounter = 1;
            const uid = () => 'pb' + (idCounter++);

            // ── CORE DATA OPERATIONS ─────────────────────────────────────
            function addSection(parentSectionId = null, parentColId = null, cols = 1) {
                const newSection = {
                    id: uid(),
                    type: 'section',
                    cols: Array(cols).fill(0).map(() => ({
                        id: uid(),
                        widgets: []
                    }))
                };

                if (parentSectionId && parentColId) {
                    const parentSec = findSection(parentSectionId);
                    const parentCol = parentSec.cols.find(c => c.id === parentColId);
                    parentCol.widgets.push(newSection);
                } else {
                    sections.push(newSection);
                }
                renderCanvas();
                return newSection;
            }

            function findSection(sectionId, searchIn = sections) {
                for (let sec of searchIn) {
                    if (sec.id === sectionId) return sec;
                    for (let col of sec.cols) {
                        for (let widget of col.widgets) {
                            if (widget.type === 'section') {
                                const found = findSection(sectionId, [widget]);
                                if (found) return found;
                            }
                        }
                    }
                }
                return null;
            }

            function removeSection(sectionId) {
                const parentSec = findParentSection(sectionId);
                if (!parentSec) {
                    sections = sections.filter(s => s.id !== sectionId);
                } else {
                    const parentCol = parentSec.cols.find(c =>
                        c.widgets.some(w => w.id === sectionId && w.type === 'section')
                    );
                    if (parentCol) {
                        parentCol.widgets = parentCol.widgets.filter(w => w.id !== sectionId);
                    }
                }
                renderCanvas();
            }

            function findParentSection(childSectionId) {
                function search(parentSections) {
                    for (let sec of parentSections) {
                        for (let col of sec.cols) {
                            for (let widget of col.widgets) {
                                if (widget.type === 'section' && widget.id === childSectionId) {
                                    return sec;
                                }
                                if (widget.type === 'section') {
                                    const found = search([widget]);
                                    if (found) return found;
                                }
                            }
                        }
                    }
                    return null;
                }
                return search(sections);
            }

            function duplicateSection(sectionId) {
                const original = findSection(sectionId);
                if (!original) return;

                const clone = JSON.parse(JSON.stringify(original));
                clone.id = uid();
                clone.cols.forEach(col => {
                    col.id = uid();
                    col.widgets.forEach(widget => widget.id = uid());
                });

                const parentSec = findParentSection(sectionId);
                if (!parentSec) {
                    const idx = sections.findIndex(s => s.id === sectionId);
                    sections.splice(idx + 1, 0, clone);
                } else {
                    const parentCol = parentSec.cols.find(c =>
                        c.widgets.some(w => w.id === sectionId)
                    );
                    const idx = parentCol.widgets.findIndex(w => w.id === sectionId);
                    parentCol.widgets.splice(idx + 1, 0, clone);
                }
                renderCanvas();
            }

            function moveSectionUp(sectionId) {
                const parentSec = findParentSection(sectionId);
                let container = parentSec ?
                    (parentSec.cols.find(c => c.widgets.some(w => w.id === sectionId))?.widgets || []) :
                    sections;

                const idx = container.findIndex(item => item.id === sectionId);
                if (idx > 0) {
                    [container[idx - 1], container[idx]] = [container[idx], container[idx - 1]];
                    renderCanvas();
                }
            }

            function moveSectionDown(sectionId) {
                const parentSec = findParentSection(sectionId);
                let container = parentSec ?
                    (parentSec.cols.find(c => c.widgets.some(w => w.id === sectionId))?.widgets || []) :
                    sections;

                const idx = container.findIndex(item => item.id === sectionId);
                if (idx < container.length - 1) {
                    [container[idx + 1], container[idx]] = [container[idx], container[idx + 1]];
                    renderCanvas();
                }
            }

            function setSectionCols(sectionId, numCols) {
                const sec = findSection(sectionId);
                if (!sec) return;

                while (sec.cols.length < numCols) {
                    sec.cols.push({
                        id: uid(),
                        widgets: []
                    });
                }
                while (sec.cols.length > numCols) {
                    const extraCol = sec.cols.pop();
                    if (extraCol.widgets.length > 0) {
                        sec.cols[0].widgets.push(...extraCol.widgets);
                    }
                }
                renderCanvas();
            }

            function removeWidget(sectionId, colId, widgetId) {
                const sec = findSection(sectionId);
                if (!sec) return;
                const col = sec.cols.find(c => c.id === colId);
                if (col) {
                    col.widgets = col.widgets.filter(w => w.id !== widgetId);
                    renderCanvas();
                }
            }

            function duplicateWidget(sectionId, colId, widgetId) {
                const sec = findSection(sectionId);
                if (!sec) return;
                const col = sec.cols.find(c => c.id === colId);
                if (!col) return;

                const widgetIdx = col.widgets.findIndex(w => w.id === widgetId);
                const original = col.widgets[widgetIdx];
                const clone = {
                    id: uid(),
                    type: original.type,
                    props: JSON.parse(JSON.stringify(original.props))
                };
                col.widgets.splice(widgetIdx + 1, 0, clone);
                renderCanvas();
            }

            function moveWidget(fromSectionId, fromColId, widgetId, toSectionId, toColId) {
                const fromSec = findSection(fromSectionId);
                const toSec = findSection(toSectionId);
                if (!fromSec || !toSec) return;

                const fromCol = fromSec.cols.find(c => c.id === fromColId);
                const toCol = toSec.cols.find(c => c.id === toColId);
                if (!fromCol || !toCol) return;

                const widgetIdx = fromCol.widgets.findIndex(w => w.id === widgetId);
                const widget = fromCol.widgets.splice(widgetIdx, 1)[0];
                toCol.widgets.push(widget);
                renderCanvas();
            }

            // ── RENDERING ────────────────────────────────────────────────
            function renderWidgetContent(widget) {
                const p = widget.props || {};
                switch (widget.type) {
                    case 'theme-section':
                        return renderThemeSection(p);
                    case 'heading':
                        return `<div class="w-heading"><${p.level||'h2'}>${p.text||'Heading'}</${p.level||'h2'}>${p.sub?`<p>${p.sub}</p>`:''}</div>`;
                    case 'text':
                        return `<div class="w-text"><p>${p.content||''}</p></div>`;
                    case 'button':
                        return `<div class="w-btn"><a href="${p.href||'#'}" class="${p.style==='outline'?'outline':''}" onclick="return false">${p.label||'Button'}</a></div>`;
                    case 'image':
                        return `<div class="w-image"><img src="${p.src}" alt="${p.alt||''}"></div>`;
                    case 'card-img':
                        return `<div class="w-card-img"><img src="${p.img}" alt="${p.title}"><div class="card-info"><h4>${p.title}</h4><p>${p.desc}</p></div></div>`;
                    case 'icon-card':
                        return `<div class="w-icon-card"><div class="icon-circle"><i class="ti ${p.icon||'ti-star'}" aria-hidden="true"></i></div><h4>${p.title||'Title'}</h4><p>${p.desc||''}</p></div>`;
                    case 'divider':
                        return `<div class="w-divider"><hr></div>`;
                    case 'badges':
                        return `<div class="w-badge-list">${(p.items||'').split(',').map(t=>`<span>${t.trim()}</span>`).join('')}</div>`;
                    case 'stats':
                        return `<div class="w-stats">${(p.items||'').split(',').map(s=>{const[n,l]=s.split('|');return`<div class="stat"><div class="num">${n}</div><div class="lbl">${l||''}</div></div>`;}).join('')}</div>`;
                    default:
                        return `<div style="color:#aaa;font-size:12px;padding:20px;text-align:center;border:2px dashed #ddd;border-radius:6px">
                            Unknown Widget: ${widget.type}<br>
                            <small>ID: ${widget.id}</small>
                        </div>`;
                }
            }

            function renderThemeSection(p) {
                const cards = (p.cards || []).map(c => `
                    <div class="ts-card">
                        <div class="tc-icon"><i class="ti ${c.icon||'ti-star'}" aria-hidden="true"></i></div>
                        <h4>${c.text||''}</h4>
                        <p>${c.desc||''}</p>
                    </div>`).join('');
                return `
                    <div class="w-theme-section">
                        <div class="ts-hero">
                            <div class="ts-hero-text">
                                <h3>${p.subtitle||''}</h3>
                                <h2>${p.title||''}</h2>
                                <p>${p.desc||''}</p>
                                <a href="${p.btnUrl||'#'}" class="ts-btn" onclick="return false">
                                    <i class="ti ti-arrow-right"></i>${p.btnText||'Learn More'}
                                </a>
                            </div>
                            ${p.image?`<div class="ts-hero-img"><img src="${p.image}" alt="Section image"></div>`:''}
                        </div>
                        <div class="ts-cards">${cards}</div>
                    </div>`;
            }

            function createWidgetElement(widget, sectionId, colId) {
                const div = document.createElement('div');
                div.className = 'pb-widget';
                div.id = widget.id;
                div.draggable = true;

                const comp = COMPONENTS.find(c => c.type === widget.type);
                const icon = comp ? comp.icon : 'ti-grid-dots';
                const label = comp ? comp.label : 'Widget';

                const toolbar = document.createElement('div');
                toolbar.className = 'widget-toolbar';
                toolbar.innerHTML = `
                    <i class="ti ${icon}" style="font-size:12px"></i>
                    <span class="toolbar-label">${label}</span>
                    <button onclick="event.stopPropagation();openWidgetProps('${sectionId}','${colId}','${widget.id}')" title="Edit"><i class="ti ti-settings" style="font-size:13px"></i></button>
                    <button onclick="event.stopPropagation();duplicateWidget('${sectionId}','${colId}','${widget.id}')" title="Duplicate"><i class="ti ti-copy" style="font-size:13px"></i></button>
                    <button onclick="event.stopPropagation();removeWidget('${sectionId}','${colId}','${widget.id}')" title="Delete"><i class="ti ti-trash" style="font-size:13px"></i></button>
                `;

                const body = document.createElement('div');
                body.className = 'widget-body';
                body.innerHTML = renderWidgetContent(widget);

                div.appendChild(toolbar);
                div.appendChild(body);

                div.addEventListener('dragstart', e => {
                    dragData = {
                        type: 'widget',
                        sectionId,
                        colId,
                        widgetId: widget.id
                    };
                    div.classList.add('dragging');
                });
                div.addEventListener('dragend', () => {
                    dragData = null;
                    div.classList.remove('dragging');
                });
                div.addEventListener('click', e => {
                    e.stopPropagation();
                    openWidgetProps(sectionId, colId, widget.id);
                });

                return div;
            }

            function renderSection(section, isNested = false) {
                const sectionEl = document.createElement('div');
                sectionEl.className = `pb-section ${isNested ? 'nested' : ''}`;
                sectionEl.id = section.id;
                sectionEl.draggable = true;

                const toolbar = document.createElement('div');
                toolbar.className = 'section-toolbar';
                toolbar.innerHTML = `
                    <i class="ti ti-grid-dots" style="font-size:14px;cursor:grab"></i>
                    <span class="toolbar-label">${isNested ? 'Nested ' : ''}Section</span>
                    <span style="font-size:10px;opacity:0.8;margin-right:6px">${section.cols.length} col${section.cols.length>1?'s':''}</span>
                    <button onclick="event.stopPropagation();moveSectionUp('${section.id}')"><i class="ti ti-chevron-up"></i></button>
                    <button onclick="event.stopPropagation();moveSectionDown('${section.id}')"><i class="ti ti-chevron-down"></i></button>
                    <button onclick="event.stopPropagation();openSectionProps('${section.id}')"><i class="ti ti-settings"></i></button>
                    <button onclick="event.stopPropagation();duplicateSection('${section.id}')"><i class="ti ti-copy"></i></button>
                    <button onclick="event.stopPropagation();removeSection('${section.id}')"><i class="ti ti-trash"></i></button>
                `;

                const inner = document.createElement('div');
                inner.className = `section-inner ${isNested ? 'nested' : ''}`;
                const colsContainer = document.createElement('div');
                colsContainer.className = 'section-cols';

                section.cols.forEach(col => {
                    const colEl = document.createElement('div');
                    colEl.className = 'section-col';
                    colEl.id = col.id;

                    if (col.widgets.length === 0) {
                        const hint = document.createElement('div');
                        hint.className = 'col-drop-hint';
                        hint.textContent = 'Drop widgets or sections here';
                        colEl.appendChild(hint);
                    } else {
                        col.widgets.forEach(widget => {
                            if (widget.type === 'section') {
                                colEl.appendChild(renderSection(widget, true));
                            } else {
                                colEl.appendChild(createWidgetElement(widget, section.id, col.id));
                            }
                        });
                    }

                    colEl.addEventListener('dragover', e => {
                        e.preventDefault();
                        e.stopPropagation();
                        colEl.classList.add('drag-over');
                    });
                    colEl.addEventListener('dragleave', e => {
                        if (!colEl.contains(e.relatedTarget)) {
                            colEl.classList.remove('drag-over');
                        }
                    });
                    colEl.addEventListener('drop', e => {
                        e.preventDefault();
                        e.stopPropagation();
                        colEl.classList.remove('drag-over');
                        handleDrop(section.id, col.id, colEl);
                    });

                    colsContainer.appendChild(colEl);
                });

                inner.appendChild(colsContainer);
                sectionEl.appendChild(toolbar);
                sectionEl.appendChild(inner);

                sectionEl.addEventListener('dragstart', e => {
                    if (e.target.closest('.pb-widget, .widget-toolbar, button')) return;
                    dragData = {
                        type: 'section',
                        sectionId: section.id
                    };
                    sectionEl.style.opacity = '0.7';
                });
                sectionEl.addEventListener('dragend', e => {
                    dragData = null;
                    sectionEl.style.opacity = '1';
                });

                return sectionEl;
            }

            function handleDrop(sectionId, colId, colEl) {
                if (activePanelType) {
                    if (activePanelType === 'section') {
                        addSection(sectionId, colId);
                    } else {
                        const comp = COMPONENTS.find(c => c.type === activePanelType);
                        const sec = findSection(sectionId);
                        const col = sec.cols.find(c => c.id === colId);
                        col.widgets.push({
                            id: uid(),
                            type: activePanelType,
                            props: JSON.parse(JSON.stringify(comp ? comp.props : {}))
                        });
                    }
                    activePanelType = null;
                    renderCanvas();
                } else if (dragData) {
                    if (dragData.type === 'widget') {
                        moveWidget(dragData.sectionId, dragData.colId, dragData.widgetId, sectionId, colId);
                    }
                }
            }

            function renderCanvas() {
                const canvas = document.getElementById('canvas');
                canvas.innerHTML = '';
                if (sections.length === 0) {
                    canvas.innerHTML =
                        '<div style="text-align:center;padding:50px;color:#999">Drag components from left panel or click "Add Section"</div>';
                } else {
                    sections.forEach(section => {
                        canvas.appendChild(renderSection(section));
                    });
                }
            }

            // ── PANEL ────────────────────────────────────────────────────
            function renderComponents() {
                const container = document.getElementById('comp-container');
                container.innerHTML = '';
                COMPONENTS.forEach(comp => {
                    const item = document.createElement('div');
                    item.className = `comp-item ${comp.custom ? 'custom-item' : ''}`;
                    item.draggable = true;
                    item.innerHTML = `<i class="ti ${comp.icon}"></i><span>${comp.label}</span>`;

                    item.addEventListener('dragstart', e => {
                        activePanelType = comp.type;
                        item.classList.add('dragging-from-panel');
                    });
                    item.addEventListener('dragend', () => {
                        item.classList.remove('dragging-from-panel');
                        setTimeout(() => activePanelType = null, 100);
                    });
                    item.addEventListener('click', () => {
                        if (comp.type === 'section') {
                            addSection();
                        } else if (sections.length === 0) {
                            const newSec = addSection();
                            const newCol = newSec.cols[0];
                            newCol.widgets.push({
                                id: uid(),
                                type: comp.type,
                                props: JSON.parse(JSON.stringify(comp.props))
                            });
                        } else {
                            const lastSec = sections[sections.length - 1];
                            lastSec.cols[0].widgets.push({
                                id: uid(),
                                type: comp.type,
                                props: JSON.parse(JSON.stringify(comp.props))
                            });
                        }
                        renderCanvas();
                    });
                    container.appendChild(item);
                });
            }

            // ── PROPERTIES PANEL ─────────────────────────────────────────
            function getWidgetPropsHTML(sectionId, colId, widgetId) {
                const section = findSection(sectionId);
                const col = section.cols.find(c => c.id === colId);
                const widget = col.widgets.find(w => w.id === widgetId);
                const comp = COMPONENTS.find(c => c.type === widget.type);
                const props = widget.props || {};

                let fields = '';

                switch (widget.type) {
                    case 'heading':
                        fields = `
                <div class="prop-field">
                    <label>Heading Text</label>
                    <input type="text" id="prop-text" value="${props.text || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','text',this.value)">
                </div>
                <div class="prop-field">
                    <label>Subtitle</label>
                    <input type="text" id="prop-sub" value="${props.sub || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','sub',this.value)">
                </div>
                <div class="prop-field">
                    <label>Level</label>
                    <select id="prop-level" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','level',this.value)">
                        <option value="h1" ${props.level === 'h1' ? 'selected' : ''}>H1</option>
                        <option value="h2" ${props.level === 'h2' ? 'selected' : ''}>H2</option>
                        <option value="h3" ${props.level === 'h3' ? 'selected' : ''}>H3</option>
                    </select>
                </div>`;
                        break;

                    case 'text':
                        fields = `
                <div class="prop-field">
                    <label>Content</label>
                    <textarea id="prop-content" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','content',this.value)">${props.content || ''}</textarea>
                </div>`;
                        break;

                    case 'button':
                        fields = `
                <div class="prop-field">
                    <label>Button Text</label>
                    <input type="text" id="prop-label" value="${props.label || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','label',this.value)">
                </div>
                <div class="prop-field">
                    <label>URL</label>
                    <input type="text" id="prop-href" value="${props.href || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','href',this.value)">
                </div>
                <div class="prop-field">
                    <label>Style</label>
                    <select id="prop-style" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','style',this.value)">
                        <option value="solid" ${props.style === 'solid' ? 'selected' : ''}>Solid</option>
                        <option value="outline" ${props.style === 'outline' ? 'selected' : ''}>Outline</option>
                    </select>
                </div>`;
                        break;

                    case 'image':
                        fields = `
                <div class="prop-field">
                    <label>Image URL</label>
                    <input type="text" id="prop-src" value="${props.src || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','src',this.value)">
                </div>
                <div class="prop-field">
                    <label>Alt Text</label>
                    <input type="text" id="prop-alt" value="${props.alt || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','alt',this.value)">
                </div>`;
                        break;

                    case 'card-img':
                        fields = `
                <div class="prop-field">
                    <label>Image URL</label>
                    <input type="text" id="prop-img" value="${props.img || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','img',this.value)">
                </div>
                <div class="prop-field">
                    <label>Title</label>
                    <input type="text" id="prop-title" value="${props.title || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','title',this.value)">
                </div>
                <div class="prop-field">
                    <label>Description</label>
                    <textarea id="prop-desc" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','desc',this.value)">${props.desc || ''}</textarea>
                </div>`;
                        break;

                    case 'icon-card':
                        fields = `
                <div class="prop-field">
                    <label>Icon</label>
                    <select id="prop-icon" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','icon',this.value)">
                        <option value="ti-rocket" ${props.icon === 'ti-rocket' ? 'selected' : ''}>ti-rocket</option>
                        <option value="ti-shield" ${props.icon === 'ti-shield' ? 'selected' : ''}>ti-shield</option>
                        <option value="ti-users" ${props.icon === 'ti-users' ? 'selected' : ''}>ti-users</option>
                        <option value="ti-trending-up" ${props.icon === 'ti-trending-up' ? 'selected' : ''}>ti-trending-up</option>
                        <option value="ti-star" ${props.icon === 'ti-star' ? 'selected' : ''}>ti-star</option>
                        <option value="ti-heart" ${props.icon === 'ti-heart' ? 'selected' : ''}>ti-heart</option>
                        <option value="ti-bolt" ${props.icon === 'ti-bolt' ? 'selected' : ''}>ti-bolt</option>
                    </select>
                </div>
                <div class="prop-field">
                    <label>Title</label>
                    <input type="text" id="prop-title" value="${props.title || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','title',this.value)">
                </div>
                <div class="prop-field">
                    <label>Description</label>
                    <textarea id="prop-desc" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','desc',this.value)">${props.desc || ''}</textarea>
                </div>`;
                        break;

                    case 'divider':
                        fields = `
                <div class="prop-field">
                    <label>Style</label>
                    <select id="prop-style" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','style',this.value)">
                        <option value="solid" ${props.style === 'solid' ? 'selected' : ''}>Solid</option>
                        <option value="dashed" ${props.style === 'dashed' ? 'selected' : ''}>Dashed</option>
                        <option value="dotted" ${props.style === 'dotted' ? 'selected' : ''}>Dotted</option>
                    </select>
                </div>`;
                        break;

                    case 'badges':
                        fields = `
                <div class="prop-field">
                    <label>Badges (comma separated)</label>
                    <textarea id="prop-items" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','items',this.value)">${props.items || ''}</textarea>
                    <small>Enter badges separated by commas: Design,Development,Marketing</small>
                </div>`;
                        break;

                    case 'stats':
                        fields = `
                <div class="prop-field">
                    <label>Stats (format: number|label, comma separated)</label>
                    <textarea id="prop-items" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','items',this.value)">${props.items || ''}</textarea>
                    <small>Format: 1,000+|Users,98%|Satisfaction,50+|Projects</small>
                </div>`;
                        break;

                    case 'theme-section':
                        fields = `
                <div class="prop-field">
                    <label>Title</label>
                    <input type="text" id="prop-title" value="${props.title || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','title',this.value)">
                </div>
                <div class="prop-field">
                    <label>Subtitle</label>
                    <input type="text" id="prop-subtitle" value="${props.subtitle || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','subtitle',this.value)">
                </div>
                <div class="prop-field">
                    <label>Description</label>
                    <textarea id="prop-desc" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','desc',this.value)">${props.desc || ''}</textarea>
                </div>
                <div class="prop-field">
                    <label>Image URL</label>
                    <input type="text" id="prop-image" value="${props.image || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','image',this.value)">
                </div>
                <div class="prop-field">
                    <label>Button Text</label>
                    <input type="text" id="prop-btnText" value="${props.btnText || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','btnText',this.value)">
                </div>
                <div class="prop-field">
                    <label>Button URL</label>
                    <input type="text" id="prop-btnUrl" value="${props.btnUrl || ''}" onchange="updateWidgetProp('${sectionId}','${colId}','${widgetId}','btnUrl',this.value)">
                </div>
                <div class="prop-field">
                    <label>Cards Data (JSON)</label>
                    <textarea id="prop-cards" rows="6" onchange="updateThemeCards('${sectionId}','${colId}','${widgetId}',this.value)">${JSON.stringify(props.cards || [], null, 2)}</textarea>
                    <small>Edit cards as JSON array</small>
                </div>`;
                        break;

                    default:
                        fields = `
                <div style="padding:20px;color:#666;text-align:center">
                    <p>Properties for <strong>${widget.type}</strong></p>
                    <small>Widget ID: ${widgetId}</small>
                </div>`;
                }

                return fields + '<button class="prop-apply" onclick="closeProp()">Done</button>';
            }

            function updateWidgetProp(sectionId, colId, widgetId, propName, value) {
                const section = findSection(sectionId);
                const col = section.cols.find(c => c.id === colId);
                const widget = col.widgets.find(w => w.id === widgetId);
                if (widget && widget.props) {
                    widget.props[propName] = value;
                    renderCanvas();
                }
            }

            function updateThemeCards(sectionId, colId, widgetId, jsonValue) {
                const section = findSection(sectionId);
                const col = section.cols.find(c => c.id === colId);
                const widget = col.widgets.find(w => w.id === widgetId);
                try {
                    const cards = JSON.parse(jsonValue);
                    if (Array.isArray(cards)) {
                        widget.props.cards = cards;
                    }
                    renderCanvas();
                } catch (e) {
                    alert('Invalid JSON format for cards');
                }
            }

            function openSectionProps(sectionId) {
                const section = findSection(sectionId);
                document.getElementById('propTitle').textContent = 'Section Properties';
                document.getElementById('propBody').innerHTML = `
                    <div class="prop-field">
                        <label>Columns</label>
                        <div class="col-select">
                            ${[1,2,3,4].map(n => 
                                `<div class="col-opt ${section.cols.length === n ? 'active' : ''}" 
                                                     onclick="setSectionCols('${sectionId}', ${n}); closeProp()">
                                                    ${n} Column${n > 1 ? 's' : ''}
                                                </div>`
                            ).join('')}
                        </div>
                    </div>
                    <button class="prop-apply" onclick="closeProp()">Done</button>`;
                document.getElementById('propPanel').classList.add('open');
            }

            function openWidgetProps(sectionId, colId, widgetId) {
                document.getElementById('propTitle').textContent = 'Widget Properties';
                document.getElementById('propBody').innerHTML = getWidgetPropsHTML(sectionId, colId, widgetId);
                document.getElementById('propPanel').classList.add('open');
            }

            function closeProp() {
                document.getElementById('propPanel').classList.remove('open');
            }

            // ── INIT ─────────────────────────────────────────────────────
            function init() {
                renderComponents();
                initRootDrop();
                addSection();
                renderCanvas();
            }

            function initRootDrop() {
                const rootDrop = document.getElementById('root-drop');
                ['dragover', 'dragenter'].forEach(event => {
                    rootDrop.addEventListener(event, e => {
                        e.preventDefault();
                        e.stopPropagation();
                        rootDrop.classList.add('drag-over');
                    });
                });
                rootDrop.addEventListener('dragleave', e => {
                    if (!rootDrop.contains(e.relatedTarget)) {
                        rootDrop.classList.remove('drag-over');
                    }
                });
                rootDrop.addEventListener('drop', e => {
                    e.preventDefault();
                    rootDrop.classList.remove('drag-over');
                    if (activePanelType) {
                        if (activePanelType === 'section') {
                            addSection();
                        } else {
                            const newSec = addSection();
                            newSec.cols[0].widgets.push({
                                id: uid(),
                                type: activePanelType,
                                props: JSON.parse(JSON.stringify(COMPONENTS.find(c => c.type ===
                                    activePanelType)?.props || {}))
                            });
                        }
                        activePanelType = null;
                        renderCanvas();
                    }
                });
            }

            document.addEventListener('click', e => {
                const panel = document.getElementById('propPanel');
                if (panel.classList.contains('open') &&
                    !panel.contains(e.target) &&
                    !e.target.closest('.widget-toolbar') &&
                    !e.target.closest('.section-toolbar')) {
                    closeProp();
                }
            });

            $('#btnSave').on('click', () => {
                console.log('PAGE DATA:', JSON.stringify(sections, null, 2));
                console.log(sections)
                alert('Check console for page structure!');
            });

            init();
        </script>
    @endpush
</x-app>
