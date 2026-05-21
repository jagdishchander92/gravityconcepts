<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageCraft Builder</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --bg: #f0f2f5;
            --surface: #fff;
            --surface2: #f7f8fa;
            --surface3: #edf0f4;
            --border: #d6dae4;
            --accent: #f89507;
            --accent2: #e05252;
            --accent3: #22c069;
            --text: #1a1d2e;
            --text2: #4a5270;
            --text3: #8a90a8;
            --panel-w: 270px;
            --prop-w: 310px;
            --toolbar-h: 48px;
            --radius: 8px;
            --font: 'Segoe UI', system-ui, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font);
            font-size: 13px;
            overflow: hidden;
            height: 100vh;
            display: flex;
            flex-direction: column
        }

        /* TOPBAR */
        .topbar {
            height: var(--toolbar-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 14px;
            gap: 8px;
            z-index: 100;
            flex-shrink: 0
        }

        .topbar-logo {
            font-weight: 800;
            font-size: 15px;
            color: var(--accent);
            letter-spacing: -.5px;
            margin-right: 6px
        }

        .topbar-logo span {
            color: var(--text2)
        }

        .topbar-sep {
            width: 1px;
            height: 20px;
            background: var(--border)
        }

        .topbar-btn {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text2);
            padding: 5px 11px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: all .15s
        }

        .topbar-btn:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .topbar-btn.primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff
        }

        .topbar-btn.primary:hover {
            opacity: .9
        }

        .topbar-spacer {
            flex: 1
        }

        .device-btns {
            display: flex;
            gap: 3px
        }

        .device-btn {
            background: none;
            border: 1px solid var(--border);
            color: var(--text3);
            padding: 5px 9px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: all .15s
        }

        .device-btn.active,
        .device-btn:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        /* LAYOUT */
        .main-layout {
            display: flex;
            flex: 1;
            overflow: hidden
        }

        /* LEFT PANEL */
        .left-panel {
            width: var(--panel-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            flex-shrink: 0
        }

        .panel-tabs {
            display: flex;
            border-bottom: 1px solid var(--border)
        }

        .panel-tab {
            flex: 1;
            padding: 9px 4px;
            text-align: center;
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
            color: var(--text3);
            transition: all .15s;
            border-bottom: 2px solid transparent
        }

        .panel-tab.active {
            color: var(--accent);
            border-bottom-color: var(--accent)
        }

        .panel-content {
            flex: 1;
            overflow-y: auto;
            padding: 8px
        }

        .panel-content::-webkit-scrollbar {
            width: 3px
        }

        .panel-content::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px
        }

        .comp-group-label {
            font-size: 9px;
            font-weight: 700;
            color: var(--text3);
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 7px 3px 3px
        }

        .comp-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5px;
            margin-bottom: 6px
        }

        .comp-item {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 9px 6px;
            cursor: grab;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            transition: all .15s;
            user-select: none
        }

        .comp-item:hover {
            border-color: var(--accent);
            background: var(--surface3);
            transform: translateY(-1px)
        }

        .comp-item i {
            font-size: 15px;
            color: var(--accent)
        }

        .comp-item span {
            font-size: 9px;
            color: var(--text2);
            font-weight: 600;
            text-align: center
        }

        .comp-item.custom-item i {
            color: #f59e0b
        }

        .comp-item.dragging-from-panel {
            opacity: .5
        }

        .tpl-item {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 9px 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
            transition: all .15s
        }

        .tpl-item:hover {
            border-color: var(--accent);
            background: var(--surface3)
        }

        .tpl-item i {
            font-size: 16px;
            color: var(--accent);
            flex-shrink: 0
        }

        .tpl-item-info h4 {
            font-size: 11px;
            font-weight: 700;
            color: var(--text)
        }

        .tpl-item-info p {
            font-size: 10px;
            color: var(--text3);
            margin-top: 1px
        }

        .tpl-badge {
            margin-left: auto;
            font-size: 9px;
            background: rgb(240 191 82 / 12%);
            color: var(--accent);
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: 700;
            flex-shrink: 0
        }

        /* CANVAS */
        .canvas-wrapper {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 18px;
            background: #e4e7ed
        }

        .canvas-wrapper::-webkit-scrollbar {
            width: 5px
        }

        .canvas-wrapper::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px
        }

        .canvas-area {
            max-width: 1100px;
            margin: 0 auto;
            min-height: 200px
        }

        .canvas-area.tablet {
            max-width: 768px
        }

        .canvas-area.mobile {
            max-width: 375px
        }

        .empty-state {
            border: 2px dashed var(--border);
            border-radius: 12px;
            padding: 55px 20px;
            text-align: center;
            color: var(--text3)
        }

        .empty-state i {
            font-size: 32px;
            display: block;
            margin-bottom: 10px;
            opacity: .3
        }

        .root-drop-zone {
            border: 2px dashed var(--border);
            border-radius: 8px;
            padding: 14px;
            text-align: center;
            color: var(--text3);
            margin-top: 10px;
            transition: all .15s;
            font-size: 11px
        }

        .root-drop-zone.drag-over {
            border-color: var(--accent);
            background: rgba(91, 82, 240, .04);
            color: var(--accent)
        }

        .add-section-root {
            display: flex;
            gap: 6px;
            margin-top: 8px
        }

        .add-sec-btn {
            flex: 1;
            background: var(--surface);
            border: 1px dashed var(--border);
            color: var(--text2);
            padding: 9px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all .15s
        }

        .add-sec-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgb(240 191 82 / 12%);
        }

        /* SECTIONS */
        .pb-section {
            border: 1px solid var(--border);
            border-radius: 7px;
            margin-bottom: 8px;
            background: var(--surface);
            position: relative;
            transition: border-color .15s
        }

        .pb-section:hover {
            border-color: var(--accent)
        }

        .pb-section.nested {
            background: var(--surface2);
            border-style: dashed;
            margin: 3px 0;
            width: 100% !important;
            flex: 1 1 100% !important;
            box-sizing: border-box;
            display: block
        }

        .pb-section.drag-over-section {
            border-color: var(--accent3);
            background: rgba(34, 192, 105, .02)
        }

        .section-toolbar {
            display: flex;
            align-items: center;
            gap: 3px;
            padding: 4px 7px;
            background: var(--surface2);
            border-bottom: 1px solid var(--border);
            border-radius: 6px 6px 0 0
        }

        .section-toolbar .section-label {
            font-size: 9px;
            font-weight: 700;
            color: var(--text2);
            letter-spacing: .5px;
            flex: 1;
            display: flex;
            align-items: center;
            gap: 4px
        }

        .section-toolbar .section-label i {
            font-size: 10px;
            color: var(--accent)
        }

        .section-toolbar button {
            background: none;
            border: none;
            color: var(--text3);
            cursor: pointer;
            padding: 3px 4px;
            border-radius: 3px;
            font-size: 11px;
            transition: all .15s
        }

        .section-toolbar button:hover {
            color: var(--text);
            background: var(--surface3)
        }

        .section-toolbar button.danger:hover {
            color: var(--accent2)
        }

        .section-body {
            padding: 6px
        }

        .section-cols-row {
            display: flex;
            gap: 5px;
            min-height: 55px
        }

        .section-col {
            background: rgba(0, 0, 0, .015);
            border: 1px dashed var(--border);
            border-radius: 5px;
            padding: 5px;
            min-height: 55px;
            transition: all .15s;
            flex-shrink: 0;
            min-width: 0;
            overflow: hidden
        }

        .section-col.drag-over {
            border-color: var(--accent);
            background: rgba(91, 82, 240, .04)
        }

        .col-empty-hint {
            color: var(--text3);
            font-size: 10px;
            text-align: center;
            padding: 12px 4px
        }

        .col-handle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 3px;
            padding: 1px 3px
        }

        .col-width-badge {
            font-size: 8px;
            background: var(--surface3);
            color: var(--text3);
            padding: 1px 4px;
            border-radius: 3px;
            font-weight: 700
        }

        /* DIV WRAPPER */
        .pb-div-wrapper {
            border: 1px solid rgba(91, 82, 240, .25);
            border-radius: 6px;
            margin-bottom: 6px;
            background: rgba(91, 82, 240, .02);
            position: relative;
            transition: border-color .15s
        }

        .pb-div-wrapper:hover {
            border-color: var(--accent)
        }

        .pb-div-wrapper.nested-div {
            margin: 3px 0;
            width: 100% !important;
            box-sizing: border-box
        }

        .div-toolbar {
            display: flex;
            align-items: center;
            gap: 3px;
            padding: 3px 7px;
            background: rgba(91, 82, 240, .07);
            border-bottom: 1px solid rgba(91, 82, 240, .15);
            border-radius: 5px 5px 0 0
        }

        .div-toolbar .div-label {
            font-size: 9px;
            font-weight: 700;
            color: var(--accent);
            flex: 1;
            display: flex;
            align-items: center;
            gap: 4px
        }

        .div-toolbar button {
            background: none;
            border: none;
            color: var(--text3);
            cursor: pointer;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 10px;
            transition: all .15s
        }

        .div-toolbar button:hover {
            color: var(--text);
            background: rgba(0, 0, 0, .05)
        }

        .div-inner {
            padding: 5px;
            min-height: 40px
        }

        .div-drop-zone {
            border: 1px dashed rgba(91, 82, 240, .3);
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            color: var(--text3);
            font-size: 10px;
            margin: 3px 0
        }

        .div-drop-zone.drag-over {
            border-color: var(--accent);
            background: rgba(91, 82, 240, .04);
            color: var(--accent)
        }

        /* WIDGETS */
        .pb-widget {
            border: 1px solid transparent;
            border-radius: 5px;
            margin-bottom: 5px;
            cursor: pointer;
            transition: all .15s;
            position: relative;
            width: 100% !important
        }

        .pb-widget:hover {
            border-color: var(--accent)
        }

        .pb-widget.dragging {
            opacity: .4
        }

        .widget-toolbar {
            display: none;
            align-items: center;
            gap: 2px;
            padding: 2px 5px;
            background: var(--accent);
            border-radius: 4px 4px 0 0
        }

        .pb-widget:hover .widget-toolbar {
            display: flex
        }

        .widget-toolbar .wtlabel {
            font-size: 9px;
            font-weight: 700;
            color: rgba(255, 255, 255, .9);
            flex: 1;
            display: flex;
            align-items: center;
            gap: 3px
        }

        .widget-toolbar button {
            background: none;
            border: none;
            color: rgba(255, 255, 255, .8);
            cursor: pointer;
            padding: 2px 3px;
            border-radius: 3px;
            font-size: 10px
        }

        .widget-toolbar button:hover {
            background: rgba(0, 0, 0, .2);
            color: #fff
        }

        .widget-body {
            padding: 3px
        }

        /* WIDGET RENDERS */
        .w-heading h1,
        .w-heading h2,
        .w-heading h3,
        .w-heading h4 {
            color: var(--text);
            line-height: 1.2
        }

        .w-heading p {
            color: var(--text2);
            font-size: 13px;
            margin-top: 4px
        }

        .w-text p {
            color: var(--text2);
            line-height: 1.6;
            font-size: 13px
        }

        .w-btn a {
            display: inline-block;
            padding: 8px 18px;
            background: var(--accent);
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600
        }

        .w-btn a.outline {
            background: none;
            border: 2px solid var(--accent);
            color: var(--accent)
        }

        .w-image img {
            width: 100%;
            border-radius: 6px;
            display: block
        }

        .w-card-img {
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            background: var(--surface2)
        }

        .w-card-img img {
            width: 100%;
            display: block
        }

        .w-card-img .cinfo {
            padding: 10px 12px
        }

        .w-card-img .cinfo h4 {
            color: var(--text);
            font-size: 13px
        }

        .w-card-img .cinfo p {
            color: var(--text2);
            font-size: 11px;
            margin-top: 3px
        }

        .w-icon-card {
            text-align: center;
            padding: 14px
        }

        .w-icon-card .ic-circle {
            width: 42px;
            height: 42px;
            background: rgba(91, 82, 240, .1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 7px
        }

        .w-icon-card .ic-circle i {
            font-size: 17px;
            color: var(--accent)
        }

        .w-icon-card h4 {
            color: var(--text);
            font-size: 13px;
            font-weight: 700
        }

        .w-icon-card p {
            color: var(--text2);
            font-size: 11px;
            margin-top: 3px
        }

        .w-divider hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: 6px 0
        }

        .w-divider hr.dashed {
            border-style: dashed
        }

        .w-divider hr.dotted {
            border-style: dotted
        }

        .w-badge-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            padding: 5px
        }

        .w-badge-list span {
            background: rgba(91, 82, 240, .1);
            color: var(--accent);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600
        }

        .w-stats {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            padding: 7px
        }

        .w-stats .stat .num {
            font-size: 19px;
            font-weight: 800;
            color: var(--accent)
        }

        .w-stats .stat .lbl {
            font-size: 10px;
            color: var(--text2)
        }

        .w-video {
            position: relative;
            border-radius: 7px;
            overflow: hidden;
            background: #000
        }

        .w-video iframe {
            width: 100%;
            height: 200px;
            border: none;
            display: block
        }

        .w-accordion {
            border: 1px solid var(--border);
            border-radius: 6px;
            overflow: hidden
        }

        .acc-item {
            border-bottom: 1px solid var(--border)
        }

        .acc-item:last-child {
            border-bottom: none
        }

        .acc-q {
            padding: 9px 13px;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
            color: var(--text);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--surface2)
        }

        .acc-q:hover {
            background: var(--surface3)
        }

        .acc-a {
            padding: 7px 13px 9px;
            font-size: 12px;
            color: var(--text2);
            background: var(--surface);
            display: none
        }

        .acc-item.open .acc-a {
            display: block
        }

        .w-progress {
            padding: 5px
        }

        .prog-item {
            margin-bottom: 7px
        }

        .prog-label {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: var(--text2);
            margin-bottom: 3px
        }

        .prog-bar {
            height: 6px;
            background: var(--surface3);
            border-radius: 10px;
            overflow: hidden
        }

        .prog-fill {
            height: 100%;
            background: var(--accent);
            border-radius: 10px
        }

        .w-testimonial {
            background: var(--surface2);
            border-radius: 7px;
            padding: 13px;
            border-left: 3px solid var(--accent)
        }

        .w-testimonial .quote {
            font-size: 12px;
            color: var(--text2);
            font-style: italic;
            line-height: 1.6
        }

        .w-testimonial .author {
            margin-top: 9px;
            font-size: 11px;
            font-weight: 700;
            color: var(--text)
        }

        .w-testimonial .role {
            font-size: 10px;
            color: var(--text3)
        }

        .w-alert {
            padding: 9px 13px;
            border-radius: 6px;
            font-size: 12px;
            display: flex;
            align-items: flex-start;
            gap: 7px
        }

        .w-alert.info {
            background: rgba(91, 82, 240, .07);
            border: 1px solid rgba(91, 82, 240, .2);
            color: #5b52f0
        }

        .w-alert.success {
            background: rgba(34, 192, 105, .07);
            border: 1px solid rgba(34, 192, 105, .2);
            color: #18a057
        }

        .w-alert.warning {
            background: rgba(234, 140, 0, .07);
            border: 1px solid rgba(234, 140, 0, .2);
            color: #c47800
        }

        .w-alert.danger {
            background: rgba(224, 82, 82, .07);
            border: 1px solid rgba(224, 82, 82, .2);
            color: #c03030
        }

        .w-spacer {
            background: repeating-linear-gradient(45deg, transparent, transparent 4px, rgba(0, 0, 0, .02) 4px, rgba(0, 0, 0, .02) 8px);
            border: 1px dashed var(--border);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text3);
            font-size: 10px
        }

        .w-list ul,
        .w-list ol {
            padding-left: 17px;
            color: var(--text2);
            font-size: 12px;
            line-height: 2
        }

        .w-html {
            font-size: 12px;
            color: var(--text2);
            padding: 3px
        }

        .w-counter {
            text-align: center;
            padding: 11px
        }

        .w-counter .counter-num {
            font-size: 34px;
            font-weight: 900;
            color: var(--accent)
        }

        .w-counter .counter-label {
            font-size: 12px;
            color: var(--text2);
            margin-top: 3px
        }

        .w-theme-section {
            background: linear-gradient(135deg, #f0f2fb, #e8eaf6);
            border-radius: 7px;
            padding: 18px
        }

        .ts-hero {
            display: flex;
            gap: 18px;
            align-items: center;
            margin-bottom: 14px
        }

        .ts-hero-text {
            flex: 1
        }

        .ts-hero-text h3 {
            font-size: 10px;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 1px
        }

        .ts-hero-text h2 {
            font-size: 19px;
            font-weight: 800;
            color: var(--text);
            margin: 3px 0
        }

        .ts-hero-text p {
            font-size: 12px;
            color: var(--text2);
            line-height: 1.5
        }

        .ts-hero-text .ts-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            padding: 7px 14px;
            background: var(--accent);
            color: #fff;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none
        }

        .ts-hero-img img {
            width: 110px;
            height: 75px;
            object-fit: cover;
            border-radius: 7px
        }

        .ts-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 7px
        }

        .ts-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 5px;
            padding: 10px 8px;
            text-align: center
        }

        .tc-icon {
            width: 30px;
            height: 30px;
            background: rgba(91, 82, 240, .1);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 5px
        }

        .tc-icon i {
            color: var(--accent);
            font-size: 13px
        }

        .ts-card h4 {
            font-size: 10px;
            font-weight: 700;
            color: var(--text)
        }

        .ts-card p {
            font-size: 9px;
            color: var(--text3);
            margin-top: 2px
        }

        /* PROP PANEL */
        .prop-panel {
            width: var(--prop-w);
            background: var(--surface);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            flex-shrink: 0
        }

        .prop-panel-header {
            padding: 10px 13px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 7px
        }

        .prop-panel-header i {
            color: var(--accent);
            font-size: 13px
        }

        .prop-panel-header span {
            font-weight: 700;
            font-size: 12px;
            flex: 1
        }

        .prop-panel-header button {
            background: none;
            border: none;
            color: var(--text3);
            cursor: pointer;
            font-size: 12px;
            padding: 3px 5px;
            border-radius: 4px
        }

        .prop-panel-header button:hover {
            color: var(--text);
            background: var(--surface2)
        }

        .prop-panel-body {
            flex: 1;
            overflow-y: auto;
            padding: 10px
        }

        .prop-panel-body::-webkit-scrollbar {
            width: 3px
        }

        .prop-panel-body::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px
        }

        .prop-panel-empty {
            color: var(--text3);
            text-align: center;
            padding: 35px 16px;
            font-size: 11px
        }

        .prop-panel-empty i {
            font-size: 26px;
            display: block;
            margin-bottom: 9px;
            opacity: .25
        }

        .prop-section {
            margin-bottom: 13px
        }

        .prop-section-title {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text3);
            margin-bottom: 7px;
            padding-bottom: 3px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 4px
        }

        .prop-section-title i {
            color: var(--accent)
        }

        .prop-field {
            margin-bottom: 7px
        }

        .prop-field label {
            display: block;
            font-size: 10px;
            font-weight: 600;
            color: var(--text2);
            margin-bottom: 3px
        }

        .prop-field input[type=text],
        .prop-field input[type=number],
        .prop-field input[type=url],
        .prop-field textarea,
        .prop-field select {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 5px;
            padding: 5px 7px;
            font-size: 11px;
            outline: none;
            transition: border-color .15s;
            font-family: inherit
        }

        .prop-field input:focus,
        .prop-field textarea:focus,
        .prop-field select:focus {
            border-color: var(--accent)
        }

        .prop-field textarea {
            resize: vertical;
            min-height: 60px
        }

        .prop-field select option {
            background: var(--surface2)
        }

        .prop-field input[type=color] {
            width: 100%;
            height: 30px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 5px;
            cursor: pointer;
            padding: 1px
        }

        .prop-field input[type=range] {
            width: 100%;
            accent-color: var(--accent)
        }

        .prop-field-row {
            display: flex;
            gap: 5px
        }

        .prop-field-row .prop-field {
            flex: 1
        }

        /* spacing 4-dir */
        .spacing-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px
        }

        .spacing-grid .prop-field label {
            font-size: 9px
        }

        .spacing-grid .prop-field input {
            padding: 4px 6px;
            font-size: 10px
        }

        /* bg image picker */
        .bg-img-picker {
            border: 1px dashed var(--border);
            border-radius: 5px;
            padding: 8px;
            cursor: pointer;
            text-align: center;
            font-size: 10px;
            color: var(--text3);
            transition: all .15s;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .bg-img-picker:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .bg-img-preview {
            position: relative;
            margin-top: 5px;
            border-radius: 5px;
            overflow: hidden
        }

        .bg-img-preview img {
            width: 100%;
            height: 60px;
            object-fit: cover;
            display: block;
            border-radius: 5px
        }

        .bg-img-preview .remove-bg {
            position: absolute;
            top: 3px;
            right: 3px;
            background: rgba(0, 0, 0, .6);
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            padding: 2px 5px;
            font-size: 10px
        }

        /* image picker widget */
        .image-wrapper {
            position: relative
        }

        .image-picker-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--surface2);
            border: 1px dashed var(--border);
            color: var(--text2);
            padding: 7px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 11px;
            width: 100%;
            transition: all .15s
        }

        .image-picker-btn:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .image-preview-box {
            margin-top: 5px;
            position: relative
        }

        .image-preview-box img {
            width: 100%;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
            display: block
        }

        .image-preview-box .remove-img-btn {
            position: absolute;
            top: 3px;
            right: 3px;
            background: rgba(0, 0, 0, .6);
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            padding: 2px 5px;
            font-size: 10px
        }

        /* BTN GROUP */
        .btn-group {
            display: flex;
            gap: 3px;
            flex-wrap: wrap
        }

        .btn-group button {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text2);
            padding: 3px 7px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 10px;
            font-weight: 600;
            transition: all .15s;
            display: flex;
            align-items: center;
            gap: 2px
        }

        .btn-group button.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff
        }

        .btn-group button:hover:not(.active) {
            border-color: var(--accent);
            color: var(--text)
        }

        /* LAYOUT PRESETS */
        .layout-presets {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4px;
            margin-bottom: 6px
        }

        .layout-preset {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 7px 3px;
            cursor: pointer;
            transition: all .15s
        }

        .layout-preset:hover {
            border-color: var(--accent)
        }

        .layout-preset.active {
            border-color: var(--accent);
            background: rgba(91, 82, 240, .08)
        }

        .layout-preset-vis {
            display: flex;
            gap: 2px;
            height: 20px
        }

        .layout-preset-vis .lp-col {
            background: rgba(91, 82, 240, .3);
            border-radius: 2px
        }

        .layout-preset-label {
            font-size: 8px;
            color: var(--text3);
            text-align: center;
            margin-top: 3px;
            font-weight: 600
        }

        /* BOOTSTRAP COL BUILDER */
        .bs-col-builder {
            display: flex;
            flex-direction: column;
            gap: 5px
        }

        .bs-col-row {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 5px;
            padding: 6px 8px
        }

        .bs-col-row label {
            font-size: 10px;
            color: var(--text2);
            font-weight: 700;
            width: 50px;
            flex-shrink: 0
        }

        .bs-col-row select {
            flex: 1;
            background: var(--surface3);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 4px;
            padding: 3px 5px;
            font-size: 10px
        }

        .bs-col-row button {
            background: none;
            border: none;
            color: var(--accent2);
            cursor: pointer;
            font-size: 11px;
            padding: 2px
        }

        /* ITEMS LIST */
        .items-list {
            border: 1px solid var(--border);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 5px
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 6px 7px;
            border-bottom: 1px solid var(--border);
            background: var(--surface2)
        }

        .item-row:last-child {
            border-bottom: none
        }

        .item-row input {
            flex: 1;
            background: transparent;
            border: none;
            color: var(--text);
            font-size: 11px;
            outline: none;
            min-width: 0
        }

        .item-row button {
            background: none;
            border: none;
            color: var(--text3);
            cursor: pointer;
            font-size: 11px;
            padding: 2px
        }

        .item-row button:hover {
            color: var(--accent2)
        }

        .add-item-btn {
            width: 100%;
            background: var(--surface2);
            border: 1px dashed var(--border);
            color: var(--accent);
            padding: 5px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 10px;
            font-weight: 700;
            transition: all .15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px
        }

        .add-item-btn:hover {
            background: rgba(91, 82, 240, .07);
            border-color: var(--accent)
        }

        /* COL MANAGE */
        .col-row-manage {
            border: 1px solid var(--border);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 5px
        }

        .col-row-item {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 7px 9px;
            border-bottom: 1px solid var(--border);
            background: var(--surface2)
        }

        .col-row-item:last-child {
            border-bottom: none
        }

        .col-row-item label {
            font-size: 10px;
            color: var(--text2);
            font-weight: 700;
            flex: 1
        }

        .col-row-item input[type=number] {
            width: 55px;
            background: var(--surface3);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 4px;
            padding: 3px 5px;
            font-size: 10px
        }

        .col-row-item select {
            background: var(--surface3);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 4px;
            padding: 3px 5px;
            font-size: 10px
        }

        /* MODAL */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .6);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .modal {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 11px;
            width: 640px;
            max-height: 78vh;
            display: flex;
            flex-direction: column;
            overflow: hidden
        }

        .modal-header {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 9px
        }

        .modal-header h3 {
            flex: 1;
            font-size: 14px;
            font-weight: 800
        }

        .modal-header button {
            background: none;
            border: none;
            color: var(--text2);
            cursor: pointer;
            font-size: 15px
        }

        .modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 14px
        }

        .modal-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 9px
        }

        .modal-tpl-card {
            border: 1px solid var(--border);
            border-radius: 7px;
            overflow: hidden;
            cursor: pointer;
            transition: all .2s
        }

        .modal-tpl-card:hover {
            border-color: var(--accent);
            transform: translateY(-2px)
        }

        .modal-tpl-card .tpl-preview {
            height: 90px;
            background: var(--surface2);
            display: flex;
            align-items: center;
            justify-content: center
        }

        .modal-tpl-card .tpl-preview i {
            font-size: 28px;
            color: var(--text3);
            opacity: .35
        }

        .modal-tpl-card .tpl-meta {
            padding: 9px 11px
        }

        .modal-tpl-card .tpl-meta h4 {
            font-size: 11px;
            font-weight: 700;
            color: var(--text)
        }

        .modal-tpl-card .tpl-meta p {
            font-size: 10px;
            color: var(--text3);
            margin-top: 2px
        }

        /* FILE MANAGER MODAL */
        .fm-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .65);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .fm-modal {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 11px;
            width: 820px;
            max-height: 82vh;
            display: flex;
            flex-direction: column;
            overflow: hidden
        }

        .fm-modal-header {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 9px
        }

        .fm-modal-header h3 {
            flex: 1;
            font-size: 14px;
            font-weight: 800
        }

        .fm-modal-header button {
            background: none;
            border: none;
            color: var(--text2);
            cursor: pointer;
            font-size: 15px
        }

        .fm-modal-body {
            flex: 1;
            overflow: hidden;
            display: flex;
            gap: 0
        }

        .fm-upload-zone {
            width: 260px;
            flex-shrink: 0;
            padding: 14px;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .fm-drop-area {
            border: 2px dashed var(--border);
            border-radius: 8px;
            padding: 18px;
            text-align: center;
            cursor: pointer;
            transition: all .15s;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 7px
        }

        .fm-drop-area:hover,
        .fm-drop-area.dragover {
            border-color: var(--accent);
            background: rgba(91, 82, 240, .04)
        }

        .fm-drop-area i {
            font-size: 26px;
            color: var(--text3);
            opacity: .5
        }

        .fm-drop-area p {
            font-size: 11px;
            color: var(--text3)
        }

        .fm-drop-area .browse-btn {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text2);
            padding: 5px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 11px;
            transition: all .15s
        }

        .fm-drop-area .browse-btn:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .fm-upload-types {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
            justify-content: center
        }

        .fm-upload-types span {
            font-size: 9px;
            background: var(--surface3);
            color: var(--text3);
            padding: 2px 5px;
            border-radius: 3px;
            font-weight: 700
        }

        .fm-files-list {
            list-style: none;
            max-height: 120px;
            overflow-y: auto
        }

        .fm-gallery {
            flex: 1;
            overflow-y: auto;
            padding: 12px
        }

        .fm-gallery::-webkit-scrollbar {
            width: 4px
        }

        .fm-gallery::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px
        }

        .fm-img-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 7px
        }

        .fm-img-item {
            border: 2px solid transparent;
            border-radius: 6px;
            overflow: hidden;
            cursor: pointer;
            transition: all .15s;
            aspect-ratio: 4/3;
            position: relative
        }

        .fm-img-item:hover {
            border-color: var(--accent)
        }

        .fm-img-item.selected {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(91, 82, 240, .3)
        }

        .fm-img-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block
        }

        .fm-img-item .fm-img-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, .55);
            color: #fff;
            font-size: 9px;
            padding: 2px 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            opacity: 0;
            transition: .15s
        }

        .fm-img-item:hover .fm-img-name {
            opacity: 1
        }

        .fm-modal-footer {
            padding: 10px 16px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 7px
        }

        .fm-modal-footer button {
            padding: 6px 16px;
            border-radius: 5px;
            border: 1px solid var(--border);
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all .15s
        }

        .fm-modal-footer .btn-cancel {
            background: var(--surface2);
            color: var(--text2)
        }

        .fm-modal-footer .btn-select {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff
        }

        .fm-modal-footer .btn-select:disabled {
            opacity: .5;
            cursor: not-allowed
        }

        .fm-upload-item {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 6px 8px;
            border: 1px solid var(--border);
            border-radius: 5px;
            background: var(--surface2);
            margin-bottom: 4px;
            font-size: 11px
        }

        .fm-upload-item .fname {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--text2)
        }

        .fm-upload-item .fstatus {
            font-size: 10px;
            font-weight: 700;
            flex-shrink: 0
        }

        .fm-prog-bar {
            height: 3px;
            background: var(--border);
            border-radius: 3px;
            margin-top: 3px;
            overflow: hidden
        }

        .fm-prog-fill {
            height: 100%;
            background: var(--accent);
            border-radius: 3px;
            transition: width .2s
        }

        /* no select */
        .no-select {
            user-select: none
        }

        @media(max-width:1100px) {
            :root {
                --panel-w: 220px;
                --prop-w: 270px
            }
        }
    </style>
</head>

<body>

    <div class="topbar">
        <div class="topbar-logo">PAGE<span>CRAFT</span></div>
        <div class="topbar-sep"></div>
        <button class="topbar-btn" onclick="openTemplateModal()"><i class="fa fa-th-large"></i> Templates</button>
        <button class="topbar-btn" onclick="previewPage()"><i class="fa fa-eye"></i> Preview</button>
        <div class="topbar-spacer"></div>
        <div class="device-btns">
            <button class="device-btn active" onclick="setDevice('desktop',this)"><i class="fa fa-desktop"></i></button>
            <button class="device-btn" onclick="setDevice('tablet',this)"><i
                    class="fa fa-tablet-screen-button"></i></button>
            <button class="device-btn" onclick="setDevice('mobile',this)"><i class="fa fa-mobile-screen"></i></button>
        </div>
        <div class="topbar-sep"></div>
        <button class="topbar-btn" onclick="undoLast()"><i class="fa fa-rotate-left"></i></button>
        <button class="topbar-btn primary" onclick="saveData()"><i class="fa fa-floppy-disk"></i> Save</button>
        <button class="topbar-btn primary" onclick="previewData()"><i class="fa fa-floppy-disk"></i> Preview</button>
    </div>

    <div class="main-layout">
        <div class="left-panel">
            <div class="panel-tabs">
                <div class="panel-tab active" onclick="switchTab('elements',this)">Elements</div>
                <div class="panel-tab" onclick="switchTab('templates',this)">Templates</div>
                <div class="panel-tab" onclick="switchTab('layers',this)">Layers</div>
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
                <div id="layers-tree"></div>
            </div>
        </div>

        <div class="canvas-wrapper">
            <div class="canvas-area" id="canvas-area">
                <div id="canvas"></div>
                <div class="root-drop-zone" id="root-drop"><i class="fa fa-plus-circle"></i> Drop widget or section here
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
                    <div style="padding:12px 12px 0;display:none" id="fmPagination">
                        <button class="topbar-btn" id="fmPrevBtn" onclick="loadImages(currentPage-1,true)"
                            style="opacity:.5"><i class="fa fa-chevron-left"></i> Prev</button>
                        <span style="color:var(--text3);font-size:11px" id="fmPageInfo">Page 1</span>
                        <button class="topbar-btn" id="fmNextBtn" onclick="loadImages(currentPage+1,true)"
                            style="opacity:.5"><i class="fa fa-chevron-right"></i> Next</button>
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

    <form id="previewForm" method="POST" action="/backend/pagecraft/preview" target="_blank"
        style="display:none;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="json" id="previewJson">
    </form>
    <script>
        // ============================
        // COMPONENT REGISTRY
        // ============================
        
        const COMPONENTS = {
            struct: [{
                    type: 'section',
                    icon: 'fa-table-columns',
                    label: 'Section'
                },
                {
                    type: 'bs-row',
                    icon: 'fa-grip',
                    label: 'BS Row'
                },
                {
                    type: 'div-wrapper',
                    icon: 'fa-code',
                    label: 'Div Wrapper'
                },
                {
                    type: 'spacer',
                    icon: 'fa-arrows-up-down',
                    label: 'Spacer'
                },
            ],
            content: [{
                    type: 'heading',
                    icon: 'fa-heading',
                    label: 'Heading',
                    props: {
                        text: 'Your Heading',
                        sub: '',
                        level: 'h2'
                    }
                },
                {
                    type: 'text',
                    icon: 'fa-align-left',
                    label: 'Text',
                    props: {
                        content: 'Lorem ipsum dolor sit amet.'
                    }
                },
                {
                    type: 'heading-n',
                    icon: 'fa-heading',
                    label: 'Heading',
                    props: {
                        text: 'Your Heading',
                        level: 'h2',
                        classes: ''
                    }
                },
                {
                    type: 'subheading',
                    icon: 'fa-text-height',
                    label: 'Subheading',
                    props: {
                        text: 'Your subheading text',
                        classes: ''
                    }
                },
                {
                    type: 'button',
                    icon: 'fa-arrow-pointer',
                    label: 'Button',
                    props: {
                        label: 'Click Me',
                        href: '#',
                        style: 'solid'
                    }
                },
                {
                    type: 'list',
                    icon: 'fa-list',
                    label: 'List',
                    props: {
                        listType: 'ul',
                        items: ['Item one', 'Item two', 'Item three']
                    }
                },
                {
                    type: 'badges',
                    icon: 'fa-tags',
                    label: 'Badges',
                    props: {
                        items: ['Design', 'Development', 'Marketing']
                    }
                },
                {
                    type: 'stats',
                    icon: 'fa-chart-bar',
                    label: 'Stats',
                    props: {
                        items: [{
                            num: '1,000+',
                            label: 'Users'
                        }, {
                            num: '98%',
                            label: 'Satisfaction'
                        }, {
                            num: '50+',
                            label: 'Projects'
                        }]
                    }
                },
                {
                    type: 'counter',
                    icon: 'fa-hashtag',
                    label: 'Counter',
                    props: {
                        num: 100,
                        label: 'Projects Done',
                        prefix: '',
                        suffix: '+'
                    }
                },
                {
                    type: 'progress',
                    icon: 'fa-bars-progress',
                    label: 'Progress',
                    props: {
                        bars: [{
                            label: 'Design',
                            val: 85
                        }, {
                            label: 'Dev',
                            val: 70
                        }]
                    }
                },
                {
                    type: 'accordion',
                    icon: 'fa-chevron-down',
                    label: 'Accordion',
                    props: {
                        items: [{
                            q: 'What is this?',
                            a: 'A great feature.'
                        }, {
                            q: 'How does it work?',
                            a: 'Very easily.'
                        }]
                    }
                },
                {
                    type: 'testimonial',
                    icon: 'fa-quote-left',
                    label: 'Testimonial',
                    props: {
                        quote: 'Amazing!',
                        author: 'John Doe',
                        role: 'CEO'
                    }
                },
                {
                    type: 'alert',
                    icon: 'fa-triangle-exclamation',
                    label: 'Alert',
                    props: {
                        text: 'This is an alert.',
                        alertType: 'info'
                    }
                },
                {
                    type: 'divider',
                    icon: 'fa-minus',
                    label: 'Divider',
                    props: {
                        style: 'solid'
                    }
                },
                {
                    type: 'icon',
                    icon: 'fa-icons',
                    label: 'Icon',
                    props: {
                        icon: 'star'
                    }
                },
            ],
            media: [{
                    type: 'image',
                    icon: 'fa-image',
                    label: 'Image',
                    props: {
                        src: 'https://picsum.photos/seed/pb/600/300',
                        alt: 'Image'
                    }
                },
                {
                    type: 'card-img',
                    icon: 'fa-id-card',
                    label: 'Image Card',
                    props: {
                        img: 'https://picsum.photos/seed/card/400/200',
                        title: 'Card Title',
                        desc: 'A short description.'
                    }
                },
                {
                    type: 'icon-card',
                    icon: 'fa-star',
                    label: 'Icon Card',
                    props: {
                        icon: 'fa-rocket',
                        title: 'Feature',
                        desc: 'Brief feature desc.'
                    }
                },
                {
                    type: 'video',
                    icon: 'fa-play-circle',
                    label: 'Video',
                    props: {
                        url: 'https://www.youtube.com/embed/dQw4w9WgXcQ'
                    }
                },
            ],
            advanced: [{
                    type: 'html',
                    icon: 'fa-code',
                    label: 'Raw HTML',
                    props: {
                        code: '<p>Custom HTML here</p>'
                    }
                },
                {
                    type: 'theme-section',
                    icon: 'fa-layer-group',
                    label: 'Theme Block',
                    props: {
                        title: 'Why Choose Us',
                        subtitle: 'Our Key Features',
                        desc: 'We deliver exceptional results.',
                        image: 'https://picsum.photos/seed/theme/400/260',
                        btnText: 'Get Started',
                        btnUrl: '#',
                        cards: [{
                            icon: 'fa-rocket',
                            text: 'Fast',
                            desc: 'Ship fast.'
                        }, {
                            icon: 'fa-shield',
                            text: 'Secure',
                            desc: 'Always safe.'
                        }, {
                            icon: 'fa-users',
                            text: 'Support',
                            desc: '24/7 help.'
                        }, {
                            icon: 'fa-chart-line',
                            text: 'Growth',
                            desc: 'Scale fast.'
                        }]
                    }
                },
            ]
        };
        const ALL_COMPONENTS = [...COMPONENTS.struct, ...COMPONENTS.content, ...COMPONENTS.media, ...COMPONENTS.advanced];

        const SECTION_TEMPLATES = [{
                id: 'hero',
                label: 'Hero Section',
                desc: 'Full-width hero with heading and button',
                icon: 'fa-house',
                build: () => buildHeroTemplate()
            },
            {
                id: 'features',
                label: '3-Column Features',
                desc: 'Three icon cards in a row',
                icon: 'fa-star',
                build: () => buildFeaturesTemplate()
            },
            {
                id: 'two-col',
                label: 'Two Column',
                desc: 'Text left, image right',
                icon: 'fa-table-columns',
                build: () => buildTwoColTemplate()
            },
            {
                id: 'stats',
                label: 'Stats Row',
                desc: 'Key numbers in a row',
                icon: 'fa-chart-bar',
                build: () => buildStatsTemplate()
            },
            {
                id: 'testimonials',
                label: 'Testimonials',
                desc: 'Customer quotes row',
                icon: 'fa-quote-left',
                build: () => buildTestimonialsTemplate()
            },
            {
                id: 'cta',
                label: 'CTA Banner',
                desc: 'Call-to-action with button',
                icon: 'fa-bullhorn',
                build: () => buildCTATemplate()
            },
        ];

        // ============================
        // STATE
        // ============================
        let sections = [];
        let history = [];
        let dragData = null;
        let activeDragType = null;
        let selectedId = null;
        let selectedType = null;
        let idCounter = 1;
        const uid = () => 'pb' + (idCounter++);

        // FM state
        // let fmCallback = null;
        let fmSelectedUrl = null;

        // ============================
        // HISTORY
        // ============================
        function saveHistory() {
            history.push(JSON.stringify(sections));
            if (history.length > 60) history.shift();
        }

        function undoLast() {
            if (history.length < 2) return;
            history.pop();
            sections = JSON.parse(history[history.length - 1]);
            renderCanvas();
            updateLayers();
        }

        // ============================
        // FIND HELPERS
        // ============================

        function findSection(id, list = sections) {
            // Search top-level first
            for (let s of list) {
                if ((s.type === 'section' || s.type === 'bs-row') && s.id === id) return s;

                // Search in cols
                if (s.cols) {
                    for (let c of s.cols) {
                        for (let w of c.widgets) {
                            if ((w.type === 'section' || w.type === 'bs-row') && w.id === id) return w;
                            // Recurse deeper
                            const found = findSection(id, [w]);
                            if (found) return found;
                        }
                    }
                }

                // Search in div children
                if (s.nodeType === 'div' && s.children) {
                    const found = findSection(id, s.children);
                    if (found) return found;
                }
            }
            return null;
        }

        function findDivWrapper(id, list = sections) {
            for (let s of list) {
                if (s.id === id && s.nodeType === 'div') return s;
                if (s.cols) {
                    for (let c of s.cols) {
                        for (let w of c.widgets) {
                            if (w.nodeType === 'div' && w.id === id) return w;
                            if (w.nodeType === 'div' || w.type === 'section' || w.type === 'bs-row') {
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
                        const w = c.widgets.find(x => x.id === widgetId &&
                            x.type !== 'section' &&
                            x.type !== 'bs-row' &&
                            x.nodeType !== 'div');
                        if (w) return {
                            widget: w,
                            section: s,
                            col: c,
                            inDiv: false
                        };

                        // Search inside nested containers
                        for (let w2 of c.widgets) {
                            if (w2.nodeType === 'div') {
                                const f = findWidgetInDiv(widgetId, w2);
                                if (f) return f;
                            } else if (w2.type === 'section' || w2.type === 'bs-row') {
                                const f = findWidget(widgetId, [w2]);
                                if (f) return f;
                            }
                        }
                    }
                }

                // Search div children (top-level)
                if (s.nodeType === 'div' && s.children) {
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
                if (ch.id === widgetId &&
                    ch.type !== 'section' &&
                    ch.type !== 'bs-row' &&
                    ch.nodeType !== 'div') {
                    return {
                        widget: ch,
                        divNode: div,
                        inDiv: true
                    };
                }

                // Recurse into nested divs/sections
                if (ch.nodeType === 'div') {
                    const f = findWidgetInDiv(widgetId, ch);
                    if (f) return f;
                } else if (ch.type === 'section' || ch.type === 'bs-row') {
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
                        if (c.widgets.some(w => w.id === id)) return c.widgets;
                    }
                }
                if (s.nodeType === 'div' && s.children && s.children.some(ch => ch.id === id)) {
                    return s.children;
                }

                // Recurse into nested containers
                if (s.cols) {
                    for (let c of s.cols) {
                        for (let w of c.widgets) {
                            if (w.type === 'section' || w.type === 'bs-row') {
                                const f = getContainerOf(id, [w]);
                                if (f) return f;
                            }
                            if (w.nodeType === 'div') {
                                const f = getContainerOf(id, w.children || []);
                                if (f) return f;
                            }
                        }
                    }
                }
                if (s.nodeType === 'div' && s.children) {
                    const f = getContainerOf(id, s.children);
                    if (f) return f;
                }
            }
            if (sections.some(s => s.id === id)) return sections;
            return null;
        }

        function getDivChildContainer(id, div) {
            if (!div.children) return null;
            if (div.children.some(c => c.id === id)) return div.children;
            for (let ch of div.children) {
                if (ch.nodeType === 'div') {
                    const f = getDivChildContainer(id, ch);
                    if (f) return f;
                }
            }
            return null;
        }

        // ============================
        // SECTION OPS
        // ============================
        function addSection(parentSectionId = null, parentColId = null, numCols = 1, colWidths = null) {
            saveHistory();
            const cols = Array(numCols).fill(0).map((_, i) => ({
                id: uid(),
                widgets: [],
                width: colWidths ? colWidths[i] : Math.floor(100 / numCols),
                flex: {
                    flexDirection: 'column',
                    flexWrap: 'nowrap',
                    alignItems: 'flex-start',
                    justifyContent: 'flex-start',
                    gap: '0'
                }
            }));
            const sec = {
                id: uid(),
                type: 'section',
                cols,
                style: {
                    background: '',
                    padding: '16px 12px',
                    margin: '0',
                    borderRadius: '0',
                    border: '',
                    flexDirection: 'row',
                    flexWrap: 'wrap',
                    alignItems: 'stretch',
                    justifyContent: 'flex-start',
                    gap: '0',
                    minHeight: '',
                    bgImage: '',
                    bgSize: 'cover',
                    bgPosition: 'center',
                    bgRepeat: 'no-repeat',
                    pt: '',
                    pr: '',
                    pb: '',
                    pl: '',
                    mt: '',
                    mr: '',
                    mb: '',
                    ml: '',
                    classes: ''
                }
            };
            if (parentSectionId && parentColId) {
                const ps = findSection(parentSectionId);
                const pc = ps.cols.find(c => c.id === parentColId);
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
                    bsCol: 'col-md-6',
                    flex: {
                        flexDirection: 'column',
                        alignItems: 'flex-start',
                        justifyContent: 'flex-start',
                        gap: '0'
                    }
                },
                {
                    id: uid(),
                    widgets: [],
                    bsCol: 'col-md-6',
                    flex: {
                        flexDirection: 'column',
                        alignItems: 'flex-start',
                        justifyContent: 'flex-start',
                        gap: '0'
                    }
                }
            ];
            const sec = {
                id: uid(),
                type: 'bs-row',
                cols,
                style: {
                    background: '',
                    padding: '16px 12px',
                    margin: '0',
                    borderRadius: '0',
                    border: '',
                    minHeight: '',
                    bgImage: '',
                    bgSize: 'cover',
                    bgPosition: 'center',
                    bgRepeat: 'no-repeat',
                    pt: '',
                    pr: '',
                    pb: '',
                    pl: '',
                    mt: '',
                    mr: '',
                    mb: '',
                    ml: '',
                    classes: ''
                }
            };
            if (parentSectionId && parentColId) {
                const ps = findSection(parentSectionId);
                const pc = ps.cols.find(c => c.id === parentColId);
                pc.widgets.push(sec);
            } else sections.push(sec);
            renderCanvas();
            updateLayers();
            selectSection(sec.id);
            return sec;
        }

        // Div Wrapper — no auto content, just classes+styles
        function addDivWrapper(parentSectionId = null, parentColId = null, parentDivId = null) {
            saveHistory();
            const div = {
                id: uid(),
                nodeType: 'div',
                children: [],
                divClasses: '',
                divStyle: '',
                inlineStyles: {
                    background: '',
                    padding: '',
                    margin: '',
                    border: '',
                    borderRadius: '',
                    display: '',
                    flexDirection: '',
                    alignItems: '',
                    justifyContent: '',
                    gap: '',
                    width: '',
                    height: '',
                    color: '',
                    fontSize: '',
                    fontWeight: '',
                    textAlign: '',
                    bgImage: '',
                    bgSize: 'cover',
                    bgPosition: 'center',
                    bgRepeat: 'no-repeat',
                    pt: '',
                    pr: '',
                    pb: '',
                    pl: '',
                    mt: '',
                    mr: '',
                    mb: '',
                    ml: ''
                }
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
                const pc = ps.cols.find(c => c.id === parentColId);
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
                const idx = container.findIndex(x => x.id === id);
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
            assignNewIds(clone);
            const container = getContainerOf(id);
            if (container) {
                const idx = container.findIndex(x => x.id === id);
                container.splice(idx + 1, 0, clone);
            }
            renderCanvas();
            updateLayers();
        }

        function assignNewIds(node) {
            node.id = uid();
            if (node.cols) node.cols.forEach(c => {
                c.id = uid();
                c.widgets.forEach(w => assignNewIds(w));
            });
            if (node.children) node.children.forEach(ch => assignNewIds(ch));
        }

        function moveSectionDir(id, dir) {
            saveHistory();
            const container = getContainerOf(id);
            if (!container) return;
            const idx = container.findIndex(x => x.id === id);
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
            const comp = ALL_COMPONENTS.find(c => c.type === type);
            const w = {
                id: uid(),
                type,
                props: props || JSON.parse(JSON.stringify(comp ? comp.props : {})),
                style: {
                    background: '',
                    padding: '',
                    margin: '',
                    border: '',
                    borderRadius: '',
                    color: '',
                    fontSize: '',
                    fontWeight: '',
                    textAlign: '',
                    opacity: '',
                    boxShadow: '',
                    bgImage: '',
                    bgSize: 'cover',
                    bgPosition: 'center',
                    bgRepeat: 'no-repeat',
                    pt: '',
                    pr: '',
                    pb: '',
                    pl: '',
                    mt: '',
                    mr: '',
                    mb: '',
                    ml: '',
                    classes: ''
                }
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
            const col = sec.cols.find(c => c.id === colId);
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
                    found.divNode.children = found.divNode.children.filter(c => c.id !== widgetId);
                } else {
                    found.col.widgets = found.col.widgets.filter(w => w.id !== widgetId);
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
            clone.id = uid();
            if (found.inDiv) {
                const idx = found.divNode.children.findIndex(c => c.id === widgetId);
                found.divNode.children.splice(idx + 1, 0, clone);
            } else {
                const idx = found.col.widgets.findIndex(w => w.id === widgetId);
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
            const idx = ws.findIndex(w => w.id === widgetId);
            const swap = idx + dir;
            if (swap < 0 || swap >= ws.length) return;
            [ws[idx], ws[swap]] = [ws[swap], ws[idx]];
            renderCanvas();
            updateLayers();
        }

        function removeDiv(divId) {
            saveHistory();
            const container = getContainerOf(divId) || getDivChildContainer(divId, {
                children: sections.flatMap(s => s.cols ? s.cols.flatMap(c => c.widgets) : s.children || [])
            });
            // fallback: search everywhere
            function removeFromList(list) {
                const idx = list.findIndex(x => x.id === divId);
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
                case 'heading':
                    return `<div class="w-heading"><${p.level||'h2'} style="margin:0">${p.text||'Heading'}</${p.level||'h2'}>${p.sub?`<p style="margin:4px 0 0">${p.sub}</p>`:''}</div>`;
                case 'heading-n':
                    return `<${p.level||'h2'} class="${p.classes||''}" style="margin:0">${p.text||'Heading'}</${p.level||'h2'}>`;
                case 'subheading':
                    return `<p class="${p.classes||''}" style="margin:4px 0 0 0">${p.subtext||'Subheading'}</p>`;
                case 'text':
                    return `<div class="w-text"><p>${(p.content||'').replace(/\n/g,'<br>')}</p></div>`;
                case 'button':
                    return `<div class="w-btn"><a href="${p.href||'#'}" class="${p.style==='outline'?'outline':''}" onclick="return false">${p.label||'Button'}</a></div>`;
                case 'image':
                    return `<div class="w-image"><img src="${p.src||''}" alt="${p.alt||''}"></div>`;
                case 'card-img':
                    return `<div class="w-card-img"><img src="${p.img||''}" alt="${p.title||''}"><div class="cinfo"><h4>${p.title||''}</h4><p>${p.desc||''}</p></div></div>`;
                case 'icon-card':
                    return `<div class="w-icon-card"><div class="ic-circle"><i class="fa ${p.icon||'fa-star'}"></i></div><h4>${p.title||'Title'}</h4><p>${p.desc||''}</p></div>`;
                case 'icon':
                    return `<div class="w-icon" style="padding:6px"><i class="fa fa-${p.icon||'star'}" style="font-size:22px;color:var(--accent)"></i></div>`;
                case 'divider':
                    return `<div class="w-divider"><hr class="${p.style||'solid'}"></div>`;
                case 'badges':
                    return `<div class="w-badge-list">${(p.items||[]).map(t=>`<span>${t}</span>`).join('')}</div>`;
                case 'stats':
                    return `<div class="w-stats">${(p.items||[]).map(s=>`<div class="stat"><div class="num">${s.num}</div><div class="lbl">${s.label}</div></div>`).join('')}</div>`;
                case 'counter':
                    return `<div class="w-counter"><div class="counter-num">${p.prefix||''}${p.num||0}${p.suffix||''}</div><div class="counter-label">${p.label||''}</div></div>`;
                case 'progress':
                    return `<div class="w-progress">${(p.bars||[]).map(b=>`<div class="prog-item"><div class="prog-label"><span>${b.label}</span><span>${b.val}%</span></div><div class="prog-bar"><div class="prog-fill" style="width:${b.val}%"></div></div></div>`).join('')}</div>`;
                case 'accordion':
                    return `<div class="w-accordion">${(p.items||[]).map((it,i)=>`<div class="acc-item" id="acci-${widget.id}-${i}"><div class="acc-q" onclick="toggleAcc('${widget.id}',${i})">${it.q}<i class="fa fa-chevron-down" style="font-size:10px"></i></div><div class="acc-a">${it.a}</div></div>`).join('')}</div>`;
                case 'testimonial':
                    return `<div class="w-testimonial"><div class="quote">"${p.quote||''}"</div><div class="author">${p.author||''}</div><div class="role">${p.role||''}</div></div>`;
                case 'alert':
                    return `<div class="w-alert ${p.alertType||'info'}"><i class="fa fa-circle-info"></i><span>${p.text||''}</span></div>`;
                case 'list':
                    return `<div class="w-list"><${p.listType||'ul'}>${(p.items||[]).map(i=>`<li>${i}</li>`).join('')}</${p.listType||'ul'}></div>`;
                case 'video':
                    return `<div class="w-video"><iframe src="${p.url||''}" allowfullscreen></iframe></div>`;
                case 'html':
                    return `<div class="w-html">${p.code||''}</div>`;
                case 'spacer': {
                    const h = p.height || 40;
                    return `<div class="w-spacer" style="height:${h}px"><span>${h}px spacer</span></div>`;
                }
                case 'theme-section':
                    return renderThemeSection(p);
                default:
                    return `<div style="color:var(--text3);padding:14px;text-align:center;border:1px dashed var(--border);border-radius:5px;font-size:11px">Unknown: ${widget.type}</div>`;
            }
        }

        function renderThemeSection(p) {
            const cards = (p.cards || []).map(c =>
                `<div class="ts-card"><div class="tc-icon"><i class="fa ${c.icon||'fa-star'}"></i></div><h4>${c.text||''}</h4><p>${c.desc||''}</p></div>`
            ).join('');
            return `<div class="w-theme-section"><div class="ts-hero"><div class="ts-hero-text"><h3>${p.subtitle||''}</h3><h2>${p.title||''}</h2><p>${p.desc||''}</p><a href="${p.btnUrl||'#'}" class="ts-btn" onclick="return false"><i class="fa fa-arrow-right"></i>${p.btnText||'Learn More'}</a></div>${p.image?`<div class="ts-hero-img"><img src="${p.image}" alt=""></div>`:''}</div><div class="ts-cards">${cards}</div></div>`;
        }

        function toggleAcc(wid, idx) {
            const el = document.getElementById(`acci-${wid}-${idx}`);
            if (el) el.classList.toggle('open');
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
                el.style.backgroundSize = sty.bgSize || 'cover';
                el.style.backgroundPosition = sty.bgPosition || 'center';
                el.style.backgroundRepeat = sty.bgRepeat || 'no-repeat';
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
                return `${t||'0'} ${r||'0'} ${b||'0'} ${l||'0'}`;
            }
            return shorthand || '';
        }

        function buildWidgetEl(widget, section, col, divNode = null) {
            // CHECK IF THIS IS ACTUALLY A SECTION/ROW/DIV - DON'T TREAT AS WIDGET
            if (widget.type === 'section' || widget.type === 'bs-row') {
                return buildSectionEl(widget, true);
            }
            if (widget.nodeType === 'div') {
                return buildDivEl(widget, true);
            }

            // Regular widget logic
            const div = document.createElement('div');
            div.className = 'pb-widget no-select';
            div.id = widget.id;
            div.draggable = true;
            applyNodeStyle(div, widget.style);
            if (widget.style && widget.style.classes) div.className += ' ' + widget.style.classes;

            const comp = ALL_COMPONENTS.find(c => c.type === widget.type);
            const icon = comp ? comp.icon : 'fa-puzzle-piece';
            const label = comp ? comp.label : 'Widget';

            div.innerHTML = `
        <div class="widget-toolbar">
            <span class="wtlabel"><i class="fa ${icon}"></i>${label}</span>
            <button onclick="event.stopPropagation();moveWidgetDir('${widget.id}',-1)" title="Up"><i class="fa fa-chevron-up"></i></button>
            <button onclick="event.stopPropagation();moveWidgetDir('${widget.id}',1)" title="Down"><i class="fa fa-chevron-down"></i></button>
            <button onclick="event.stopPropagation();duplicateWidget('${widget.id}')" title="Duplicate"><i class="fa fa-copy"></i></button>
            <button onclick="event.stopPropagation();removeWidget('${widget.id}')" title="Delete"><i class="fa fa-trash"></i></button>
        </div>
        <div class="widget-body">${renderWidgetContent(widget)}</div>`;

            div.addEventListener('dragstart', e => {
                dragData = {
                    type: 'widget',
                    widgetId: widget.id
                };
                div.classList.add('dragging');
                e.stopPropagation();
            });
            div.addEventListener('dragend', () => {
                dragData = null;
                div.classList.remove('dragging');
            });
            div.addEventListener('click', e => {
                e.stopPropagation();
                selectWidget(widget.id);
            });
            return div;
        }

        function buildDivEl(divNode, isNested = false) {
            const el = document.createElement('div');
            el.className = `pb-div-wrapper${isNested?' nested-div':''}`;
            el.id = divNode.id;
            if (isNested) {
                el.style.width = '100%';
                el.style.boxSizing = 'border-box';
            }
            // apply inline styles
            const s = divNode.inlineStyles || {};
            applyNodeStyle(el, s);
            if (divNode.divStyle) {
                // parse inline style string
                try {
                    const tmp = document.createElement('div');
                    tmp.style.cssText = divNode.divStyle;
                    Array.from(tmp.style).forEach(k => {
                        if (!el.style[k]) el.style[k] = tmp.style[k];
                    });
                } catch (e) {}
            }
            const toolbar = document.createElement('div');
            toolbar.className = 'div-toolbar';
            const classPreview = divNode.divClasses ?
                `<span style="font-size:9px;opacity:.7;margin-left:4px;font-weight:400">.${divNode.divClasses.split(' ').join(' .')}</span>` :
                '';
            toolbar.innerHTML =
                `
<span class="div-label"><i class="fa fa-code"></i>&lt;div&gt;${classPreview}</span>
<button onclick="event.stopPropagation();selectDiv('${divNode.id}')" title="Settings"><i class="fa fa-sliders"></i></button>
<button onclick="event.stopPropagation();addDivWrapper(null,null,'${divNode.id}')" title="Add Nested Div"><i class="fa fa-plus"></i>&lt;div&gt;</button>
<button onclick="event.stopPropagation();removeDiv('${divNode.id}')" title="Delete"><i class="fa fa-trash"></i></button>`;
            const inner = document.createElement('div');
            inner.className = 'div-inner';
            inner.id = 'div-inner-' + divNode.id;
            if (divNode.children && divNode.children.length === 0) {
                const hint = document.createElement('div');
                hint.className = 'div-drop-zone';
                hint.textContent = 'Drop elements into this div';
                inner.appendChild(hint);
            } else {
                // In buildDivEl(), REPLACE the children loop:
                (divNode.children || []).forEach(ch => {
                    if (ch.type === 'section' || ch.type === 'bs-row') {
                        inner.appendChild(buildSectionEl(ch, true));
                    } else if (ch.nodeType === 'div') {
                        inner.appendChild(buildDivEl(ch, true));
                    } else {
                        // ✅ Regular widgets only
                        inner.appendChild(buildWidgetEl(ch, null, null, divNode));
                    }
                });
            }
            inner.addEventListener('dragover', e => {
                e.preventDefault();
                e.stopPropagation();
                inner.classList.add('drag-over');
            });
            inner.addEventListener('dragleave', e => {
                if (!inner.contains(e.relatedTarget)) inner.classList.remove('drag-over');
            });
            inner.addEventListener('drop', e => {
                e.preventDefault();
                e.stopPropagation();
                inner.classList.remove('drag-over');
                handleDivDrop(divNode.id);
            });
            el.appendChild(toolbar);
            el.appendChild(inner);
            el.addEventListener('click', e => {
                e.stopPropagation();
                selectDiv(divNode.id);
            });
            return el;
        }

        function buildSectionEl(section, isNested = false) {
            const div = document.createElement('div');
            div.className = `pb-section${isNested?' nested':''}`;
            div.id = section.id;
            if (isNested) {
                div.style.width = '100%';
                div.style.flex = '1 1 100%';
                div.style.minWidth = '0';
            }
            const sty = section.style || {};
            applyNodeStyle(div, sty);
            if (sty.classes) div.className += ' ' + sty.classes;

            const isBsRow = section.type === 'bs-row';
            const toolbar = document.createElement('div');
            toolbar.className = 'section-toolbar';
            toolbar.innerHTML =
                `
<span class="section-label"><i class="fa ${isBsRow?'fa-grip':'fa-table-columns'}"></i>${isNested?'Inner ':''} ${isBsRow?'BS Row':'Section'} (${section.cols.length} col${section.cols.length>1?'s':''})</span>
<button onclick="event.stopPropagation();moveSectionDir('${section.id}',-1)"><i class="fa fa-chevron-up"></i></button>
<button onclick="event.stopPropagation();moveSectionDir('${section.id}',1)"><i class="fa fa-chevron-down"></i></button>
<button onclick="event.stopPropagation();selectSection('${section.id}')"><i class="fa fa-sliders"></i></button>
<button onclick="event.stopPropagation();duplicateSection('${section.id}')"><i class="fa fa-copy"></i></button>
<button class="danger" onclick="event.stopPropagation();removeSection('${section.id}')"><i class="fa fa-trash"></i></button>`;

            const body = document.createElement('div');
            body.className = 'section-body';
            const colsRow = document.createElement('div');

            if (isBsRow) {
                colsRow.className = 'row';
                colsRow.style.margin = '0';
            } else {
                colsRow.className = 'section-cols-row';
                if (sty.flexDirection) colsRow.style.flexDirection = sty.flexDirection;
                if (sty.flexWrap) colsRow.style.flexWrap = sty.flexWrap;
                if (sty.alignItems) colsRow.style.alignItems = sty.alignItems;
                if (sty.justifyContent) colsRow.style.justifyContent = sty.justifyContent;
                if (sty.gap) colsRow.style.gap = sty.gap;
            }

            section.cols.forEach(col => {
                const colEl = document.createElement('div');
                colEl.id = col.id;
                if (isBsRow) {
                    colEl.className = (col.bsCol || 'col-md-6') + ' pb-bs-col';
                    colEl.style.border = '1px dashed var(--border)';
                    colEl.style.borderRadius = '4px';
                    colEl.style.padding = '5px';
                    colEl.style.minHeight = '50px';
                } else {
                    colEl.className = 'section-col';
                    const w = col.width || Math.floor(100 / section.cols.length);
                    colEl.style.flex = `0 0 calc(${w}% - 3px)`;
                    colEl.style.width = `calc(${w}% - 3px)`;
                    colEl.style.minWidth = '0';
                    colEl.style.overflow = 'hidden';
                    if (col.flex) {
                        const cf = col.flex;
                        colEl.style.display = 'flex';
                        colEl.style.flexDirection = cf.flexDirection || 'column';
                        colEl.style.flexWrap = cf.flexWrap || 'wrap';
                        colEl.style.alignItems = cf.alignItems || 'flex-start';
                        colEl.style.justifyContent = cf.justifyContent || 'flex-start';
                        if (cf.gap) colEl.style.gap = cf.gap;
                    }
                }
                const handle = document.createElement('div');
                handle.className = 'col-handle';
                handle.innerHTML = isBsRow ? `<span class="col-width-badge">${col.bsCol||'col-md-6'}</span>` :
                    `<span class="col-width-badge">${col.width||Math.floor(100/section.cols.length)}%</span>`;
                colEl.appendChild(handle);

                if (col.widgets.length === 0) {
                    const hint = document.createElement('div');
                    hint.className = 'col-empty-hint';
                    hint.textContent = 'Drop here';
                    colEl.appendChild(hint);
                } else {
                    // In buildSectionEl(), REPLACE the col widgets loop:
                    col.widgets.forEach(widget => {
                        if (widget.type === 'section' || widget.type === 'bs-row') {
                            colEl.appendChild(buildSectionEl(widget, true));
                        } else if (widget.nodeType === 'div') {
                            colEl.appendChild(buildDivEl(widget, true));
                        } else {
                            // ✅ Regular widgets only
                            colEl.appendChild(buildWidgetEl(widget, section, col));
                        }
                    });
                }
                colEl.addEventListener('dragover', e => {
                    e.preventDefault();
                    e.stopPropagation();
                    colEl.classList.add('drag-over');
                });
                colEl.addEventListener('dragleave', e => {
                    if (!colEl.contains(e.relatedTarget)) colEl.classList.remove('drag-over');
                });
                colEl.addEventListener('drop', e => {
                    e.preventDefault();
                    e.stopPropagation();
                    colEl.classList.remove('drag-over');
                    handleColDrop(section.id, col.id);
                });
                colsRow.appendChild(colEl);
            });

            body.appendChild(colsRow);
            div.appendChild(toolbar);
            div.appendChild(body);
            div.addEventListener('click', e => {
                e.stopPropagation();
                selectSection(section.id);
            });
            div.addEventListener('dragover', e => {
                e.preventDefault();
                div.classList.add('drag-over-section');
            });
            div.addEventListener('dragleave', e => {
                if (!div.contains(e.relatedTarget)) div.classList.remove('drag-over-section');
            });
            div.addEventListener('drop', e => {
                e.preventDefault();
                e.stopPropagation();
                div.classList.remove('drag-over-section');
            });
            return div;
        }

        function handleColDrop(sectionId, colId) {
            if (activeDragType) {
                if (activeDragType === 'section') addSection(sectionId, colId);
                else if (activeDragType === 'bs-row') addBsRowSection(sectionId, colId);
                else if (activeDragType === 'div-wrapper') addDivWrapper(sectionId, colId);
                else addWidget(sectionId, colId, activeDragType);
                activeDragType = null;
            } else if (dragData && dragData.type === 'widget') {
                const found = findWidget(dragData.widgetId);
                if (!found) return;
                const sec = findSection(sectionId);
                const col = sec.cols.find(c => c.id === colId);
                if (found.col && found.col.id === colId) return;
                const srcList = found.inDiv ? found.divNode.children : found.col.widgets;
                const idx = srcList.findIndex(w => w.id === dragData.widgetId);
                const w = srcList.splice(idx, 1)[0];
                col.widgets.push(w);
                saveHistory();
                renderCanvas();
                updateLayers();
                dragData = null;
            }
        }


        function handleDivDrop(divId) {
            if (activeDragType) {
                // Panel drag (section, bs-row, div-wrapper, or widget)
                if (activeDragType === 'div-wrapper') {
                    addDivWrapper(null, null, divId);
                } else if (activeDragType === 'section') {
                    // Add section inside div
                    saveHistory();
                    const divNode = findDivWrapper(divId);
                    if (divNode) {
                        const sec = {
                            id: uid(),
                            type: 'section',
                            cols: [{
                                id: uid(),
                                widgets: [],
                                width: 100,
                                flex: {
                                    flexDirection: 'column',
                                    flexWrap: 'nowrap',
                                    alignItems: 'flex-start',
                                    justifyContent: 'flex-start',
                                    gap: '0'
                                }
                            }],
                            style: {
                                background: '',
                                padding: '16px 12px',
                                margin: '0',
                                borderRadius: '0',
                                border: '',
                                flexDirection: 'row',
                                flexWrap: 'wrap',
                                alignItems: 'stretch',
                                justifyContent: 'flex-start',
                                gap: '0',
                                minHeight: '',
                                bgImage: '',
                                bgSize: 'cover',
                                bgPosition: 'center',
                                bgRepeat: 'no-repeat',
                                pt: '',
                                pr: '',
                                pb: '',
                                pl: '',
                                mt: '',
                                mr: '',
                                mb: '',
                                ml: '',
                                classes: ''
                            }
                        };
                        divNode.children.push(sec);
                        renderCanvas();
                        updateLayers();
                    }
                } else if (activeDragType === 'bs-row') {
                    // Add BS row inside div
                    saveHistory();
                    const divNode = findDivWrapper(divId);
                    if (divNode) {
                        const sec = {
                            id: uid(),
                            type: 'bs-row',
                            cols: [{
                                id: uid(),
                                widgets: [],
                                bsCol: 'col-md-12',
                                flex: {
                                    flexDirection: 'column',
                                    alignItems: 'flex-start',
                                    justifyContent: 'flex-start',
                                    gap: '0'
                                }
                            }],
                            style: {
                                background: '',
                                padding: '16px 12px',
                                margin: '0',
                                borderRadius: '0',
                                border: '',
                                minHeight: '',
                                bgImage: '',
                                bgSize: 'cover',
                                bgPosition: 'center',
                                bgRepeat: 'no-repeat',
                                pt: '',
                                pr: '',
                                pb: '',
                                pl: '',
                                mt: '',
                                mr: '',
                                mb: '',
                                ml: '',
                                classes: ''
                            }
                        };
                        divNode.children.push(sec);
                        renderCanvas();
                        updateLayers();
                    }
                } else {
                    // Add widget to div (existing logic)
                    saveHistory();
                    const comp = ALL_COMPONENTS.find(c => c.type === activeDragType);
                    const divNode = findDivWrapper(divId);
                    if (divNode) {
                        const w = {
                            id: uid(),
                            type: activeDragType,
                            props: JSON.parse(JSON.stringify(comp ? comp.props : {})),
                            style: {
                                background: '',
                                padding: '',
                                margin: '',
                                border: '',
                                borderRadius: '',
                                color: '',
                                fontSize: '',
                                fontWeight: '',
                                textAlign: '',
                                opacity: '',
                                boxShadow: '',
                                bgImage: '',
                                bgSize: 'cover',
                                bgPosition: 'center',
                                bgRepeat: 'no-repeat',
                                pt: '',
                                pr: '',
                                pb: '',
                                pl: '',
                                mt: '',
                                mr: '',
                                mb: '',
                                ml: '',
                                classes: ''
                            }
                        };
                        divNode.children.push(w);
                        renderCanvas();
                        updateLayers();
                    }
                }
                activeDragType = null;
            } else if (dragData && dragData.type === 'widget') {
                // Widget drag between divs or from col to div
                saveHistory();
                const found = findWidget(dragData.widgetId);
                if (!found) return;

                const divNode = findDivWrapper(divId);
                if (!divNode) return;

                // Remove from source
                if (found.inDiv) {
                    found.divNode.children = found.divNode.children.filter(c => c.id !== dragData.widgetId);
                } else {
                    found.col.widgets = found.col.widgets.filter(w => w.id !== dragData.widgetId);
                }

                // Add to target div
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
            const canvas = document.getElementById('canvas');
            canvas.innerHTML = '';
            if (sections.length === 0) {
                canvas.innerHTML =
                    '<div class="empty-state"><i class="fa fa-wand-magic-sparkles"></i><p>Drag elements from the left panel or click "Add Section"</p></div>';
            } else {
                sections.forEach(s => {
                    if (s.type === 'section' || s.type === 'bs-row') canvas.appendChild(buildSectionEl(s));
                    else if (s.nodeType === 'div') canvas.appendChild(buildDivEl(s));
                });
            }
        }

        // ============================
        // SELECTION & PROPS
        // ============================
        function selectSection(id) {
            selectedId = id;
            selectedType = 'section';
            const sec = findSection(id);
            if (!sec) return;
            document.getElementById('propPanelTitle').textContent = sec.type === 'bs-row' ? 'BS Row Settings' :
                'Section Settings';
            document.getElementById('propPanelBody').innerHTML = buildSectionPropsHTML(sec);
        }

        function selectDiv(id) {
            selectedId = id;
            selectedType = 'div';
            const div = findDivWrapper(id);
            if (!div) return;
            document.getElementById('propPanelTitle').textContent = 'Div Wrapper Settings';
            document.getElementById('propPanelBody').innerHTML = buildDivPropsHTML(div);
        }

        function selectWidget(id) {
            selectedId = id;
            selectedType = 'widget';
            const found = findWidget(id);
            if (!found) return;
            document.getElementById('propPanelTitle').textContent = 'Widget Properties';
            document.getElementById('propPanelBody').innerHTML = buildWidgetPropsHTML(found.widget, found.section, found
                .col);
        }

        function clearPropPanel() {
            selectedId = null;
            selectedType = null;
            document.getElementById('propPanelTitle').textContent = 'Properties';
            document.getElementById('propPanelBody').innerHTML =
                '<div class="prop-panel-empty"><i class="fa fa-arrow-pointer"></i>Click any element to edit</div>';
        }

        // ============================
        // SPACING FIELD HTML helper
        // ============================
        function spacingFields(prefix, label, sty, updateFn) {
            return `<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand"></i>${label}</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(sty[prefix+'t']||sty.padding||sty.margin||'')}" placeholder="0" onchange="${updateFn}('${prefix}t',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(sty[prefix+'r']||sty.padding||sty.margin||'')}" placeholder="0" onchange="${updateFn}('${prefix}r',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(sty[prefix+'b']||sty.padding||sty.margin||'')}" placeholder="0" onchange="${updateFn}('${prefix}b',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(sty[prefix+'l']||sty.padding||sty.margin||'')}" placeholder="0" onchange="${updateFn}('${prefix}l',this.value)"></div>
</div>
</div>`;
        }

        // ============================
        // PROPS HTML - SECTION
        // ============================
        function buildSectionPropsHTML(sec) {
            const sty = sec.style || {};
            const isBsRow = sec.type === 'bs-row';
            let colsHTML = '';
            if (isBsRow) {
                colsHTML = `<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-grip"></i> Bootstrap Columns</div>
<div class="bs-col-builder" id="bs-cols-${sec.id}">
${sec.cols.map((col,i)=>`<div class="bs-col-row">
                                                                                                                            <label>Col ${i+1}</label>
                                                                                                                            <select onchange="updateBsColClass('${sec.id}','${col.id}',this.value)">
                                                                                                                            ${['col-12','col-md-1','col-md-2','col-md-3','col-md-4','col-md-5','col-md-6','col-md-7','col-md-8','col-md-9','col-md-10','col-md-11','col-md-12','col-lg-3','col-lg-4','col-lg-6','col-lg-8','col'].map(v=>`<option value="${v}" ${col.bsCol===v?'selected':''}>${v}</option>`).join('')}
                                                                                                                            </select>
                                                                                                                            <button onclick="removeBsCol('${sec.id}','${col.id}')"><i class="fa fa-xmark"></i></button>
                                                                                                                            </div>`).join('')}
</div>
<button class="add-item-btn" style="margin-top:5px" onclick="addBsCol('${sec.id}')"><i class="fa fa-plus"></i> Add Column</button>
</div>`;
            } else {
                colsHTML = `<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-table-columns"></i> Columns</div>
<div class="layout-presets">
${[1,2,3,4].map(n=>`<div class="layout-preset ${sec.cols.length===n?'active':''}" onclick="setSectionCols('${sec.id}',${n})"><div class="layout-preset-vis">${Array(n).fill('<div class="lp-col" style="flex:1"></div>').join('')}</div><div class="layout-preset-label">${n} Col${n>1?'s':''}</div></div>`).join('')}
</div>
<div class="col-row-manage">
${sec.cols.map((col,i)=>`<div class="col-row-item"><label>Col ${i+1}</label><input type="number" min="5" max="100" value="${col.width||Math.floor(100/sec.cols.length)}" onchange="setColWidth('${sec.id}','${col.id}',this.value)"><span style="font-size:9px;color:var(--text3)">%</span><button style="background:none;border:none;cursor:pointer;color:var(--text3);font-size:10px" onclick="openColFlexProps('${sec.id}','${col.id}')"><i class="fa fa-arrows-to-dot"></i></button></div>`).join('')}
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-layer-group"></i> Flexbox (Row)</div>
<div class="prop-field"><label>Direction</label>
<div class="btn-group">${['row','column','row-reverse','column-reverse'].map(v=>`<button class="${(sty.flexDirection||'row')===v?'active':''}" onclick="updateSectionStyle('${sec.id}','flexDirection','${v}')">${v}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Wrap</label>
<div class="btn-group">${['wrap','nowrap','wrap-reverse'].map(v=>`<button class="${(sty.flexWrap||'wrap')===v?'active':''}" onclick="updateSectionStyle('${sec.id}','flexWrap','${v}')">${v}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Align Items</label>
<div class="btn-group">${['stretch','flex-start','flex-end','center','baseline'].map(v=>`<button class="${(sty.alignItems||'stretch')===v?'active':''}" onclick="updateSectionStyle('${sec.id}','alignItems','${v}')">${v.replace('flex-','')}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Justify Content</label>
<div class="btn-group">${['flex-start','flex-end','center','space-between','space-around','space-evenly'].map(v=>`<button class="${(sty.justifyContent||'flex-start')===v?'active':''}" onclick="updateSectionStyle('${sec.id}','justifyContent','${v}')">${v.replace('flex-','')}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Gap</label><input type="text" value="${esc(sty.gap||'0')}" onchange="updateSectionStyle('${sec.id}','gap',this.value)"></div>
</div>`;
            }

            return colsHTML + `
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-palette"></i> Appearance</div>
<div class="prop-field"><label>Classes</label><input type="text" value="${esc(sty.classes||'')}" placeholder="container row d-flex..." onchange="updateSectionStyle('${sec.id}','classes',this.value)"></div>
<div class="prop-field"><label>Background</label><input type="text" value="${esc(sty.background||'')}" placeholder="#fff or gradient..." onchange="updateSectionStyle('${sec.id}','background',this.value)"></div>
<div class="prop-field"><label>BG Color Picker</label><input type="color" value="${sty.background&&sty.background.startsWith('#')?sty.background:'#ffffff'}" onchange="updateSectionStyle('${sec.id}','background',this.value)"></div>
<div class="prop-field"><label>Background Image</label>
<div class="bg-img-picker" onclick="openFM(url=>{updateSectionStyle('${sec.id}','bgImage',url);})">
<i class="fa fa-image"></i><span>${sty.bgImage?'Change Image':'Pick from Media'}</span>
</div>
${sty.bgImage?`<div class="bg-img-preview"><img src="${esc(sty.bgImage)}" alt=""><button class="remove-bg" onclick="updateSectionStyle('${sec.id}','bgImage','')">✕</button></div>`:''}
</div>
${sty.bgImage?`<div class="prop-field-row">
                                                                                                                            <div class="prop-field"><label>BG Size</label><select onchange="updateSectionStyle('${sec.id}','bgSize',this.value)">
                                                                                                                            ${['cover','contain','auto','100% 100%'].map(v=>`<option value="${v}" ${sty.bgSize===v?'selected':''}>${v}</option>`).join('')}
                                                                                                                            </select></div>
                                                                                                                            <div class="prop-field"><label>BG Position</label><select onchange="updateSectionStyle('${sec.id}','bgPosition',this.value)">
                                                                                                                            ${['center','top','bottom','left','right','center top','center bottom'].map(v=>`<option value="${v}" ${sty.bgPosition===v?'selected':''}>${v}</option>`).join('')}
                                                                                                                            </select></div>
                                                                                                                            </div>
                                                                                                                            <div class="prop-field"><label>BG Repeat</label><div class="btn-group">
                                                                                                                            ${['no-repeat','repeat','repeat-x','repeat-y'].map(v=>`<button class="${(sty.bgRepeat||'no-repeat')===v?'active':''}" onclick="updateSectionStyle('${sec.id}','bgRepeat','${v}')">${v}</button>`).join('')}
                                                                                                                            </div></div>`:''}
<div class="prop-field-row">
<div class="prop-field"><label>Border</label><input type="text" value="${esc(sty.border||'')}" placeholder="1px solid #ccc" onchange="updateSectionStyle('${sec.id}','border',this.value)"></div>
<div class="prop-field"><label>Radius</label><input type="text" value="${esc(sty.borderRadius||'')}" placeholder="8px" onchange="updateSectionStyle('${sec.id}','borderRadius',this.value)"></div>
</div>
<div class="prop-field"><label>Min Height</label><input type="text" value="${esc(sty.minHeight||'')}" placeholder="300px" onchange="updateSectionStyle('${sec.id}','minHeight',this.value)"></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand-arrows-alt"></i> Padding (px / rem)</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(sty.pt||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(sty.pr||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(sty.pb||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(sty.pl||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','pl',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-arrows-left-right"></i> Margin</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(sty.mt||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','mt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(sty.mr||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','mr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(sty.mb||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','mb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(sty.ml||'')}" placeholder="0" onchange="updateSectionStyle('${sec.id}','ml',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-plus"></i> Add Inner Section</div>
${sec.cols.map((col,i)=>`<button class="add-item-btn" style="margin-bottom:3px" onclick="addSection('${sec.id}','${col.id}')"><i class="fa fa-plus"></i> Inner Section → Col ${i+1}</button><button class="add-item-btn" style="margin-bottom:3px" onclick="addBsRowSection('${sec.id}','${col.id}')"><i class="fa fa-grip"></i> BS Row → Col ${i+1}</button><button class="add-item-btn" style="margin-bottom:5px" onclick="addDivWrapper('${sec.id}','${col.id}')"><i class="fa fa-code"></i> Div → Col ${i+1}</button>`).join('')}
</div>`;
        }

        // ============================
        // PROPS HTML - DIV WRAPPER
        // ============================
        function buildDivPropsHTML(div) {
            const s = div.inlineStyles || {};
            return `
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-code"></i> Div Attributes</div>
<div class="prop-field"><label>Classes</label><input type="text" value="${esc(div.divClasses||'')}" placeholder="container row d-flex fw-bold..." onchange="updateDivProp('${div.id}','divClasses',this.value)"></div>
<div class="prop-field"><label>Inline Style (raw CSS)</label><textarea placeholder="color:red; font-size:14px;" onchange="updateDivProp('${div.id}','divStyle',this.value)">${esc(div.divStyle||'')}</textarea></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-palette"></i> Visual Styles</div>
<div class="prop-field"><label>Background</label><input type="text" value="${esc(s.background||'')}" placeholder="transparent" onchange="updateDivStyle('${div.id}','background',this.value)"></div>
<div class="prop-field"><label>BG Color</label><input type="color" value="${s.background&&s.background.startsWith('#')?s.background:'#ffffff'}" onchange="updateDivStyle('${div.id}','background',this.value)"></div>
<div class="prop-field"><label>Background Image</label>
<div class="bg-img-picker" onclick="openFM(url=>{updateDivStyle('${div.id}','bgImage',url);})">
<i class="fa fa-image"></i><span>${s.bgImage?'Change Image':'Pick from Media'}</span>
</div>
${s.bgImage?`<div class="bg-img-preview"><img src="${esc(s.bgImage)}" alt=""><button class="remove-bg" onclick="updateDivStyle('${div.id}','bgImage','')">✕</button></div>`:''}
</div>
${s.bgImage?`<div class="prop-field-row">
                                                                                                                            <div class="prop-field"><label>BG Size</label><select onchange="updateDivStyle('${div.id}','bgSize',this.value)">${['cover','contain','auto'].map(v=>`<option ${s.bgSize===v?'selected':''}>${v}</option>`).join('')}</select></div>
                                                                                                                            <div class="prop-field"><label>BG Pos</label><select onchange="updateDivStyle('${div.id}','bgPosition',this.value)">${['center','top','bottom','left','right'].map(v=>`<option ${s.bgPosition===v?'selected':''}>${v}</option>`).join('')}</select></div>
                                                                                                                            </div>`:''}
<div class="prop-field-row">
<div class="prop-field"><label>Border</label><input type="text" value="${esc(s.border||'')}" placeholder="1px solid" onchange="updateDivStyle('${div.id}','border',this.value)"></div>
<div class="prop-field"><label>Radius</label><input type="text" value="${esc(s.borderRadius||'')}" placeholder="6px" onchange="updateDivStyle('${div.id}','borderRadius',this.value)"></div>
</div>
<div class="prop-field-row">
<div class="prop-field"><label>Width</label><input type="text" value="${esc(s.width||'')}" placeholder="100%" onchange="updateDivStyle('${div.id}','width',this.value)"></div>
<div class="prop-field"><label>Height</label><input type="text" value="${esc(s.height||'')}" placeholder="auto" onchange="updateDivStyle('${div.id}','height',this.value)"></div>
</div>
<div class="prop-field"><label>Color</label><input type="text" value="${esc(s.color||'')}" placeholder="inherit" onchange="updateDivStyle('${div.id}','color',this.value)"></div>
<div class="prop-field"><label>Font Size</label><input type="text" value="${esc(s.fontSize||'')}" placeholder="14px" onchange="updateDivStyle('${div.id}','fontSize',this.value)"></div>
<div class="prop-field"><label>Display</label>
<div class="btn-group">${['block','flex','grid','inline','inline-block','inline-flex','none'].map(v=>`<button class="${s.display===v?'active':''}" onclick="updateDivStyleDirect('${div.id}','display','${v}')">${v}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Flex Direction</label>
<div class="btn-group">${['row','column','row-reverse','column-reverse'].map(v=>`<button class="${s.flexDirection===v?'active':''}" onclick="updateDivStyleDirect('${div.id}','flexDirection','${v}')">${v}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Align Items</label>
<div class="btn-group">${['flex-start','flex-end','center','stretch','baseline'].map(v=>`<button class="${s.alignItems===v?'active':''}" onclick="updateDivStyleDirect('${div.id}','alignItems','${v}')">${v.replace('flex-','')}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Justify Content</label>
<div class="btn-group">${['flex-start','flex-end','center','space-between','space-around'].map(v=>`<button class="${s.justifyContent===v?'active':''}" onclick="updateDivStyleDirect('${div.id}','justifyContent','${v}')">${v.replace('flex-','')}</button>`).join('')}</div>
</div>
<div class="prop-field"><label>Gap</label><input type="text" value="${esc(s.gap||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','gap',this.value)"></div>
<div class="prop-field"><label>Box Shadow</label><input type="text" value="${esc(s.boxShadow||'')}" placeholder="0 2px 8px rgba(0,0,0,.1)" onchange="updateDivStyle('${div.id}','boxShadow',this.value)"></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand-arrows-alt"></i> Padding</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.pt||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','pt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.pr||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','pr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.pb||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','pb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.pl||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','pl',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-arrows-left-right"></i> Margin</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.mt||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','mt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.mr||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','mr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.mb||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','mb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.ml||'')}" placeholder="0" onchange="updateDivStyle('${div.id}','ml',this.value)"></div>
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
            let content = '';
            switch (widget.type) {
                case 'heading':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-heading"></i> Content</div>
<div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text||'')}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
<div class="prop-field"><label>Subtitle</label><input type="text" value="${esc(p.sub||'')}" onchange="updateWidgetProp('${widget.id}','sub',this.value)"></div>
<div class="prop-field"><label>Level</label><div class="btn-group">${['h1','h2','h3','h4'].map(v=>`<button class="${(p.level||'h2')===v?'active':''}" onclick="updateWidgetPropDirect('${widget.id}','level','${v}')">${v.toUpperCase()}</button>`).join('')}</div></div></div>`;
                    break;
                case 'text':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-align-left"></i> Content</div><div class="prop-field"><label>Content</label><textarea onchange="updateWidgetProp('${widget.id}','content',this.value)">${esc(p.content||'')}</textarea></div></div>`;
                    break;
                case 'button':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-arrow-pointer"></i> Button</div>
<div class="prop-field"><label>Label</label><input type="text" value="${esc(p.label||'')}" onchange="updateWidgetProp('${widget.id}','label',this.value)"></div>
<div class="prop-field"><label>URL</label><input type="url" value="${esc(p.href||'')}" onchange="updateWidgetProp('${widget.id}','href',this.value)"></div>
<div class="prop-field"><label>Style</label><div class="btn-group">${['solid','outline'].map(v=>`<button class="${(p.style||'solid')===v?'active':''}" onclick="updateWidgetPropDirect('${widget.id}','style','${v}')">${v}</button>`).join('')}</div></div></div>`;
                    break;
                case 'image':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-image"></i> Image</div>
<div class="prop-field"><label>Image</label>
<div class="image-wrapper">
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetProp('${widget.id}','src',url);document.getElementById('img-prev-${widget.id}').src=url;document.getElementById('img-prev-wrap-${widget.id}').style.display='block';})"><i class="fa fa-images"></i> Pick from Media</button>
<div class="image-preview-box" id="img-prev-wrap-${widget.id}" style="${p.src?'':'display:none'}"><img id="img-prev-${widget.id}" src="${esc(p.src||'')}" alt=""><button class="remove-img-btn" onclick="updateWidgetProp('${widget.id}','src','');document.getElementById('img-prev-wrap-${widget.id}').style.display='none'">✕</button></div>
<div class="prop-field" style="margin-top:5px"><label>Or paste URL</label><input type="url" value="${esc(p.src||'')}" placeholder="https://..." onchange="updateWidgetProp('${widget.id}','src',this.value)"></div>
</div>
</div>
<div class="prop-field"><label>Alt Text</label><input type="text" value="${esc(p.alt||'')}" onchange="updateWidgetProp('${widget.id}','alt',this.value)"></div></div>`;
                    break;
                case 'card-img':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-id-card"></i> Image Card</div>
<div class="prop-field"><label>Image</label>
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetProp('${widget.id}','img',url);})"><i class="fa fa-images"></i> Pick from Media</button>
<div class="prop-field" style="margin-top:5px"><label>Or paste URL</label><input type="url" value="${esc(p.img||'')}" onchange="updateWidgetProp('${widget.id}','img',this.value)"></div>
</div>
<div class="prop-field"><label>Title</label><input type="text" value="${esc(p.title||'')}" onchange="updateWidgetProp('${widget.id}','title',this.value)"></div>
<div class="prop-field"><label>Description</label><textarea onchange="updateWidgetProp('${widget.id}','desc',this.value)">${esc(p.desc||'')}</textarea></div></div>`;
                    break;
                case 'icon-card':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-star"></i> Icon Card</div>
<div class="prop-field"><label>Icon (fa-...)</label><input type="text" value="${esc(p.icon||'')}" onchange="updateWidgetProp('${widget.id}','icon',this.value)"></div>
<div class="prop-field"><label>Title</label><input type="text" value="${esc(p.title||'')}" onchange="updateWidgetProp('${widget.id}','title',this.value)"></div>
<div class="prop-field"><label>Description</label><textarea onchange="updateWidgetProp('${widget.id}','desc',this.value)">${esc(p.desc||'')}</textarea></div></div>`;
                    break;
                case 'icon':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-icons"></i> Icon</div>
<div class="prop-field"><label>Icon name (without fa-)</label><input type="text" value="${esc(p.icon||'')}" placeholder="star, heart, rocket..." onchange="updateWidgetProp('${widget.id}','icon',this.value)"></div></div>`;
                    break;
                case 'divider':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-minus"></i> Divider</div>
<div class="prop-field"><label>Style</label><div class="btn-group">${['solid','dashed','dotted'].map(v=>`<button class="${(p.style||'solid')===v?'active':''}" onclick="updateWidgetPropDirect('${widget.id}','style','${v}')">${v}</button>`).join('')}</div></div></div>`;
                    break;
                case 'spacer':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-arrows-up-down"></i> Spacer</div>
<div class="prop-field"><label>Height (px)</label><input type="number" value="${p.height||40}" min="4" max="400" onchange="updateWidgetProp('${widget.id}','height',+this.value)"></div></div>`;
                    break;
                case 'video':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-play-circle"></i> Video</div>
<div class="prop-field"><label>Embed URL</label><input type="url" value="${esc(p.url||'')}" onchange="updateWidgetProp('${widget.id}','url',this.value)"></div></div>`;
                    break;
                case 'html':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-code"></i> HTML</div>
<div class="prop-field"><label>Code</label><textarea rows="5" style="font-family:monospace" onchange="updateWidgetProp('${widget.id}','code',this.value)">${esc(p.code||'')}</textarea></div></div>`;
                    break;
                case 'testimonial':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-quote-left"></i> Testimonial</div>
<div class="prop-field"><label>Quote</label><textarea onchange="updateWidgetProp('${widget.id}','quote',this.value)">${esc(p.quote||'')}</textarea></div>
<div class="prop-field"><label>Author</label><input type="text" value="${esc(p.author||'')}" onchange="updateWidgetProp('${widget.id}','author',this.value)"></div>
<div class="prop-field"><label>Role</label><input type="text" value="${esc(p.role||'')}" onchange="updateWidgetProp('${widget.id}','role',this.value)"></div></div>`;
                    break;
                case 'alert':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-triangle-exclamation"></i> Alert</div>
<div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text||'')}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
<div class="prop-field"><label>Type</label><div class="btn-group">${['info','success','warning','danger'].map(v=>`<button class="${(p.alertType||'info')===v?'active':''}" onclick="updateWidgetPropDirect('${widget.id}','alertType','${v}')">${v}</button>`).join('')}</div></div></div>`;
                    break;
                case 'counter':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-hashtag"></i> Counter</div>
<div class="prop-field"><label>Number</label><input type="number" value="${p.num||0}" onchange="updateWidgetProp('${widget.id}','num',+this.value)"></div>
<div class="prop-field-row"><div class="prop-field"><label>Prefix</label><input type="text" value="${esc(p.prefix||'')}" onchange="updateWidgetProp('${widget.id}','prefix',this.value)"></div>
<div class="prop-field"><label>Suffix</label><input type="text" value="${esc(p.suffix||'')}" onchange="updateWidgetProp('${widget.id}','suffix',this.value)"></div></div>
<div class="prop-field"><label>Label</label><input type="text" value="${esc(p.label||'')}" onchange="updateWidgetProp('${widget.id}','label',this.value)"></div></div>`;
                    break;
                case 'badges':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-tags"></i> Badges</div>
<div class="items-list">${(p.items||[]).map((t,i)=>`<div class="item-row"><input value="${esc(t)}" onchange="updateArrItem('${widget.id}','items',${i},this.value)"><button onclick="removeArrItem('${widget.id}','items',${i})"><i class="fa fa-xmark"></i></button></div>`).join('')}</div>
<button class="add-item-btn" onclick="addArrItem('${widget.id}','items','New Badge')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case 'list':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-list"></i> List</div>
<div class="prop-field"><label>Type</label><div class="btn-group">${['ul','ol'].map(v=>`<button class="${(p.listType||'ul')===v?'active':''}" onclick="updateWidgetPropDirect('${widget.id}','listType','${v}')">${v==='ul'?'Unordered':'Ordered'}</button>`).join('')}</div></div>
<div class="items-list">${(p.items||[]).map((t,i)=>`<div class="item-row"><input value="${esc(t)}" onchange="updateArrItem('${widget.id}','items',${i},this.value)"><button onclick="removeArrItem('${widget.id}','items',${i})"><i class="fa fa-xmark"></i></button></div>`).join('')}</div>
<button class="add-item-btn" onclick="addArrItem('${widget.id}','items','New item')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case 'stats':
                    content = `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-chart-bar"></i> Stats</div>
<div class="items-list">${(p.items||[]).map((it,i)=>`<div class="item-row"><input value="${esc(it.num)}" placeholder="1000+" style="width:65px" onchange="updateStatItem('${widget.id}',${i},'num',this.value)"><input value="${esc(it.label)}" placeholder="Label" onchange="updateStatItem('${widget.id}',${i},'label',this.value)"><button onclick="removeStatItem('${widget.id}',${i})"><i class="fa fa-xmark"></i></button></div>`).join('')}</div>
<button class="add-item-btn" onclick="addStatItem('${widget.id}')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case 'progress':
                    content = `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-bars-progress"></i> Progress</div>
<div class="items-list">${(p.bars||[]).map((b,i)=>`<div class="item-row"><input value="${esc(b.label)}" placeholder="Label" onchange="updateProgressItem('${widget.id}',${i},'label',this.value)"><input type="number" value="${b.val}" min="0" max="100" style="width:52px" onchange="updateProgressItem('${widget.id}',${i},'val',+this.value)">%<button onclick="removeProgressItem('${widget.id}',${i})"><i class="fa fa-xmark"></i></button></div>`).join('')}</div>
<button class="add-item-btn" onclick="addProgressItem('${widget.id}')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case 'accordion':
                    content = `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-chevron-down"></i> Accordion</div>
<div class="items-list">${(p.items||[]).map((it,i)=>`<div class="item-row" style="flex-direction:column;align-items:stretch;gap:3px"><input value="${esc(it.q)}" placeholder="Question" onchange="updateAccItem('${widget.id}',${i},'q',this.value)"><input value="${esc(it.a)}" placeholder="Answer" onchange="updateAccItem('${widget.id}',${i},'a',this.value)"><button onclick="removeAccItem('${widget.id}',${i})" style="align-self:flex-end"><i class="fa fa-xmark"></i></button></div>`).join('')}</div>
<button class="add-item-btn" onclick="addAccItem('${widget.id}')"><i class="fa fa-plus"></i> Add</button></div>`;
                    break;
                case 'theme-section':
                    content =
                        `<div class="prop-section"><div class="prop-section-title"><i class="fa fa-layer-group"></i> Theme Block</div>
<div class="prop-field"><label>Title</label><input type="text" value="${esc(p.title||'')}" onchange="updateWidgetProp('${widget.id}','title',this.value)"></div>
<div class="prop-field"><label>Subtitle</label><input type="text" value="${esc(p.subtitle||'')}" onchange="updateWidgetProp('${widget.id}','subtitle',this.value)"></div>
<div class="prop-field"><label>Description</label><textarea onchange="updateWidgetProp('${widget.id}','desc',this.value)">${esc(p.desc||'')}</textarea></div>
<div class="prop-field"><label>Image</label>
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetProp('${widget.id}','image',url);})"><i class="fa fa-images"></i> Pick from Media</button>
<div class="prop-field" style="margin-top:4px"><input type="url" value="${esc(p.image||'')}" placeholder="or paste URL" onchange="updateWidgetProp('${widget.id}','image',this.value)"></div>
</div>
<div class="prop-field"><label>Button Text</label><input type="text" value="${esc(p.btnText||'')}" onchange="updateWidgetProp('${widget.id}','btnText',this.value)"></div>
<div class="prop-field"><label>Button URL</label><input type="url" value="${esc(p.btnUrl||'')}" onchange="updateWidgetProp('${widget.id}','btnUrl',this.value)"></div></div>`;
                    break;

                case 'heading-n':
                    content = `<div class="prop-section">
        <div class="prop-section-title"><i class="fa fa-heading"></i> Heading</div>
        <div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text||'')}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
        <div class="prop-field"><label>Level</label>
            <div class="btn-group">
                ${['h1','h2','h3','h4','h5','h6'].map(v=>`<button class="${(p.level||'h2')===v?'active':''}" onclick="updateWidgetPropDirect('${widget.id}','level','${v}')">${v}</button>`).join('')}
            </div>
        </div>
        <div class="prop-field"><label>Classes</label><input type="text" value="${esc(p.classes||'')}" placeholder="fw-bold text-center mb-0..." onchange="updateWidgetProp('${widget.id}','classes',this.value)"></div>
    </div>`;
                    break;
                case 'subheading':
                    content = `<div class="prop-section">
        <div class="prop-section-title"><i class="fa fa-text-height"></i> Subheading</div>
        <div class="prop-field"><label>Text</label><input type="text" value="${esc(p.text||'')}" onchange="updateWidgetProp('${widget.id}','text',this.value)"></div>
        <div class="prop-field"><label>Classes</label><input type="text" value="${esc(p.classes||'')}" placeholder="text-muted lead fst-italic..." onchange="updateWidgetProp('${widget.id}','classes',this.value)"></div>
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
<div class="prop-field"><label>Classes</label><input type="text" value="${esc(s.classes||'')}" placeholder="d-flex justify-content-center..." onchange="updateWidgetStyle('${widget.id}','classes',this.value)"></div>
<div class="prop-field"><label>Background</label><input type="text" value="${esc(s.background||'')}" placeholder="transparent" onchange="updateWidgetStyle('${widget.id}','background',this.value)"></div>
<div class="prop-field"><label>Background Image</label>
<button class="image-picker-btn" onclick="openFM(url=>{updateWidgetStyleDirect('${widget.id}','bgImage',url);})"><i class="fa fa-images"></i> Pick BG Image</button>
${s.bgImage?`<div class="bg-img-preview" style="margin-top:4px"><img src="${esc(s.bgImage)}" alt=""><button class="remove-bg" onclick="updateWidgetStyleDirect('${widget.id}','bgImage','')">✕</button></div>`:''}
</div>
<div class="prop-field-row">
<div class="prop-field"><label>Color</label><input type="text" value="${esc(s.color||'')}" placeholder="inherit" onchange="updateWidgetStyle('${widget.id}','color',this.value)"></div>
<div class="prop-field"><label>Font Size</label><input type="text" value="${esc(s.fontSize||'')}" placeholder="14px" onchange="updateWidgetStyle('${widget.id}','fontSize',this.value)"></div>
</div>
<div class="prop-field"><label>Text Align</label>
<div class="btn-group">${['left','center','right','justify'].map(v=>`<button class="${(s.textAlign||'')===v?'active':''}" onclick="updateWidgetStyleDirect('${widget.id}','textAlign','${v}')"><i class="fa fa-align-${v==='justify'?'justify':v}"></i></button>`).join('')}</div>
</div>
<div class="prop-field"><label>Font Weight</label>
<div class="btn-group">${['400','600','700','900'].map(v=>`<button class="${(s.fontWeight||'')===v?'active':''}" onclick="updateWidgetStyleDirect('${widget.id}','fontWeight','${v}')">${v}</button>`).join('')}</div>
</div>
<div class="prop-field-row">
<div class="prop-field"><label>Border</label><input type="text" value="${esc(s.border||'')}" placeholder="1px solid" onchange="updateWidgetStyle('${widget.id}','border',this.value)"></div>
<div class="prop-field"><label>Radius</label><input type="text" value="${esc(s.borderRadius||'')}" placeholder="6px" onchange="updateWidgetStyle('${widget.id}','borderRadius',this.value)"></div>
</div>
<div class="prop-field"><label>Box Shadow</label><input type="text" value="${esc(s.boxShadow||'')}" placeholder="0 2px 8px rgba(0,0,0,.1)" onchange="updateWidgetStyle('${widget.id}','boxShadow',this.value)"></div>
<div class="prop-field"><label>Opacity</label><input type="range" min="0" max="1" step="0.05" value="${s.opacity||1}" oninput="updateWidgetStyle('${widget.id}','opacity',+this.value)"></div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-expand-arrows-alt"></i> Padding</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.pt||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.pr||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.pb||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.pl||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','pl',this.value)"></div>
</div>
</div>
<div class="prop-section">
<div class="prop-section-title"><i class="fa fa-arrows-left-right"></i> Margin</div>
<div class="spacing-grid">
<div class="prop-field"><label>Top</label><input type="text" value="${esc(s.mt||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','mt',this.value)"></div>
<div class="prop-field"><label>Right</label><input type="text" value="${esc(s.mr||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','mr',this.value)"></div>
<div class="prop-field"><label>Bottom</label><input type="text" value="${esc(s.mb||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','mb',this.value)"></div>
<div class="prop-field"><label>Left</label><input type="text" value="${esc(s.ml||'')}" placeholder="0" onchange="updateWidgetStyle('${widget.id}','ml',this.value)"></div>
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
        function esc(v) {
            return String(v).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
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
            while (sec.cols.length < n) sec.cols.push({
                id: uid(),
                widgets: [],
                width: Math.floor(100 / n),
                flex: {}
            });
            while (sec.cols.length > n) {
                const extra = sec.cols.pop();
                if (extra.widgets.length) sec.cols[0].widgets.push(...extra.widgets);
            }
            sec.cols.forEach(c => c.width = Math.floor(100 / n));
            renderCanvas();
            requestAnimationFrame(() => selectSection(secId));
        }

        function setColWidth(secId, colId, val) {
            const sec = findSection(secId);
            const col = sec.cols.find(c => c.id === colId);
            if (col) {
                col.width = parseInt(val) || 10;
                renderCanvas();
                requestAnimationFrame(() => selectSection(secId));
            }
        }

        function openColFlexProps(secId, colId) {
            const sec = findSection(secId);
            const col = sec.cols.find(c => c.id === colId);
            const cf = col.flex || {};
            document.getElementById('propPanelTitle').textContent = 'Column Flex';
            document.getElementById('propPanelBody').innerHTML = `
<div class="prop-section">
<button style="background:none;border:none;color:var(--accent);cursor:pointer;font-size:11px;margin-bottom:8px" onclick="selectSection('${secId}')">← Back to Section</button>
<div class="prop-section-title"><i class="fa fa-layer-group"></i> Column Flex</div>
<div class="prop-field"><label>Direction</label><div class="btn-group">${['column','row','row-reverse','column-reverse'].map(v=>`<button class="${(cf.flexDirection||'column')===v?'active':''}" onclick="updateColFlex('${secId}','${colId}','flexDirection','${v}')">${v}</button>`).join('')}</div></div>
<div class="prop-field"><label>Align Items</label><div class="btn-group">${['flex-start','flex-end','center','stretch'].map(v=>`<button class="${(cf.alignItems||'flex-start')===v?'active':''}" onclick="updateColFlex('${secId}','${colId}','alignItems','${v}')">${v.replace('flex-','')}</button>`).join('')}</div></div>
<div class="prop-field"><label>Justify Content</label><div class="btn-group">${['flex-start','flex-end','center','space-between','space-around'].map(v=>`<button class="${(cf.justifyContent||'flex-start')===v?'active':''}" onclick="updateColFlex('${secId}','${colId}','justifyContent','${v}')">${v.replace('flex-','')}</button>`).join('')}</div></div>
<div class="prop-field"><label>Gap</label><input type="text" value="${cf.gap||'0'}" onchange="updateColFlex('${secId}','${colId}','gap',this.value)"></div>
</div>`;
        }

        function updateColFlex(secId, colId, prop, val) {
            saveHistory();
            const sec = findSection(secId);
            const col = sec.cols.find(c => c.id === colId);
            if (!col.flex) col.flex = {};
            col.flex[prop] = val;
            renderCanvas();
            openColFlexProps(secId, colId);
        }

        function updateBsColClass(secId, colId, val) {
            const sec = findSection(secId);
            const col = sec.cols.find(c => c.id === colId);
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
                bsCol: 'col-md-6',
                flex: {}
            });
            renderCanvas();
            requestAnimationFrame(() => selectSection(secId));
        }

        function removeBsCol(secId, colId) {
            saveHistory();
            const sec = findSection(secId);
            const idx = sec.cols.findIndex(c => c.id === colId);
            if (idx >= 0) {
                const extra = sec.cols.splice(idx, 1)[0];
                if (extra.widgets.length && sec.cols.length > 0) sec.cols[0].widgets.push(...extra.widgets);
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
            const found = findWidget(widgetId);
            if (!found) return;
            found.widget.props[prop] = val;
            const el = document.getElementById(widgetId);
            if (el) {
                const body = el.querySelector('.widget-body');
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
                    background: 'background',
                    border: 'border',
                    borderRadius: 'borderRadius',
                    boxShadow: 'boxShadow',
                    opacity: 'opacity',
                    color: 'color',
                    fontSize: 'fontSize',
                    fontWeight: 'fontWeight',
                    textAlign: 'textAlign'
                };
                if (styleProps[prop]) el.style[prop] = val;
                if (prop === 'bgImage') renderCanvas();
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
                    num: '0',
                    label: 'Label'
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
                    label: 'Skill',
                    val: 50
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
                    q: 'Question?',
                    a: 'Answer here.'
                });
                refreshWidget(wid);
                requestAnimationFrame(() => selectWidget(wid));
            }
        }

        function refreshWidget(wid) {
            const el = document.getElementById(wid);
            if (el) {
                const body = el.querySelector('.widget-body');
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
            document.getElementById('fmUrlInput').value = '';
            document.querySelectorAll('.fm-img-item').forEach(i => i.classList.remove('selected'));
            document.getElementById('fmModal').style.display = 'flex';
            loadImages(1, false);
            initDmUploader();
        }

        function closeFM() {
            document.getElementById('fmModal').style.display = 'none';
            fmCallback = null;
            nearestInput = null;
            nearestWrapper = null;
            selected_image = null;
        }

        function confirmFMSelect() {
            const urlInput = document.getElementById('fmUrlInput').value.trim();
            const url = urlInput || selected_image;
            if (!url) {
                alert('Please select an image or paste a URL.');
                return;
            }
            if (fmCallback) fmCallback(url);
            closeFM();
        }

        function selectFMImage(url, el) {
            document.querySelectorAll('.fm-img-item').forEach(i => i.classList.remove('selected'));
            el.classList.add('selected');
            selected_image = url;
            document.getElementById('fmUrlInput').value = url;
            updateSelectBtn();
        }

        function updateSelectBtn() {
            const hasSelection = selected_image || document.getElementById('fmUrlInput').value.trim();
            document.getElementById('fmSelectBtn').disabled = !hasSelection;
        }

        // ========== YOUR AJAX IMAGE LOADING ==========
        function loadImages(page = 1, append = false) {
            currentPage = page;
            const grid = document.getElementById('fmImgGrid');

            if (!append) {
                grid.innerHTML =
                    '<div style="grid-column:1/-1;text-align:center;padding:30px;color:var(--text3);font-size:11px"><i class="fa fa-spinner fa-spin"></i> Loading...</div>';
            }

            // YOUR AJAX CALL - REPLACE BASE_URL with your endpoint
            fetch(`/backend/file-manager/images?page=${page}&limit=32`)
                .then(res => res.json())
                .then(data => {

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

                    grid.innerHTML = fmImages.map(img => buildImageHtml(img)).join('');

                    document.querySelectorAll('.fm-img-item').forEach(item => {
                        item.addEventListener('click', function() {
                            selectFMImage(this.dataset.url, this);
                        });
                    });

                    updatePagination();
                })
                .catch(err => {
                    console.error('Load images error:', err);

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
            const pagination = document.getElementById('fmPagination');
            const prevBtn = document.getElementById('fmPrevBtn');
            const nextBtn = document.getElementById('fmNextBtn');
            const pageInfo = document.getElementById('fmPageInfo');

            pagination.style.display = totalPages > 1 ? 'flex' : 'none';
            prevBtn.style.opacity = currentPage > 1 ? '1' : '.5';
            prevBtn.disabled = currentPage <= 1;
            nextBtn.style.opacity = currentPage < totalPages ? '1' : '.5';
            nextBtn.disabled = currentPage >= totalPages;
            pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
        }

        // ========== YOUR UPLOAD LOGIC ==========
        function initDmUploader() {
            const dropArea = document.getElementById('fmDropArea');
            const fileInput = document.getElementById('fmFileInput');
            const filesList = document.getElementById('fmFilesList');

            // Drag & Drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.add('dragover'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => dropArea.classList.remove('dragover'), false);
            });

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            fileInput.addEventListener('change', function(e) {
                handleFiles(e.target.files);
                e.target.value = '';
            });

            function handleFiles(files) {
                Array.from(files).forEach(uploadFile);
            }

            function uploadFile(file) {
                if (!file.type.startsWith('image/')) return;

                const item = showUploadItem(file);
                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('/backend/file-manager/upload', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.location) {
                            item.classList.remove('uploading');
                            item.classList.add('success');
                            item.querySelector('.fstatus').textContent = 'Done ✓';
                            loadImages(1, false); // Refresh gallery
                        } else {
                            throw new Error(data.error || 'Upload failed');
                        }
                    })
                    .catch(err => {
                        item.classList.remove('uploading');
                        item.classList.add('error');
                        item.querySelector('.fstatus').textContent = 'Error ✗';
                    });
            }

            function showUploadItem(file) {
                const li = document.createElement('li');
                li.className = 'fm-upload-item uploading';
                li.innerHTML = `
                    <span class="fname">${file.name}</span>
                    <span class="fstatus">Uploading...</span>
                    <div class="fm-prog-bar"><div class="fm-prog-fill" style="width:0%"></div></div>
                    <button onclick="this.parentElement.remove()" style="background:none;border:none;color:var(--text3);cursor:pointer;font-size:11px;padding:0"><i class="fa fa-xmark"></i></button>
                `;
                document.getElementById('fmFilesList').appendChild(li);
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
            sec.style.padding = '40px 20px';
            sec.style.background = 'linear-gradient(135deg,#1a1d27,#22263a)';
            addWidget(sec.id, sec.cols[0].id, 'heading', {
                text: 'Build Something Amazing',
                sub: 'The next-gen page builder',
                level: 'h1'
            });
            addWidget(sec.id, sec.cols[0].id, 'text', {
                content: 'Start building beautiful pages with our intuitive drag & drop interface.'
            });
            addWidget(sec.id, sec.cols[0].id, 'button', {
                label: 'Get Started Free',
                href: '#',
                style: 'solid'
            });
            return sec;
        }

        function buildFeaturesTemplate() {
            const sec = addSection(null, null, 3);
            sec.style.padding = '28px 14px';
            [0, 1, 2].forEach(idx => {
                const icons = ['fa-rocket', 'fa-shield-halved', 'fa-users'];
                const titles = ['Lightning Fast', 'Fort Knox Security', '24/7 Support'];
                const descs = ['Optimized for peak performance.', 'Enterprise-grade protection.',
                    'Our team is always ready.'
                ];
                addWidget(sec.id, sec.cols[idx].id, 'icon-card', {
                    icon: icons[idx],
                    title: titles[idx],
                    desc: descs[idx]
                });
            });
            return sec;
        }

        function buildTwoColTemplate() {
            const sec = addSection(null, null, 2, [50, 50]);
            sec.style.padding = '28px 14px';
            addWidget(sec.id, sec.cols[0].id, 'heading', {
                text: 'Our Story',
                sub: 'Who we are',
                level: 'h2'
            });
            addWidget(sec.id, sec.cols[0].id, 'text', {
                content: 'We are a passionate team dedicated to building the best tools.'
            });
            addWidget(sec.id, sec.cols[0].id, 'button', {
                label: 'Learn More',
                href: '#',
                style: 'outline'
            });
            addWidget(sec.id, sec.cols[1].id, 'image', {
                src: 'https://picsum.photos/seed/story/600/400',
                alt: 'Our story'
            });
            return sec;
        }

        function buildStatsTemplate() {
            const sec = addSection(null, null, 1);
            sec.style.padding = '28px 14px';
            addWidget(sec.id, sec.cols[0].id, 'stats', {
                items: [{
                    num: '10,000+',
                    label: 'Happy Customers'
                }, {
                    num: '99.9%',
                    label: 'Uptime'
                }, {
                    num: '150+',
                    label: 'Countries'
                }, {
                    num: '5★',
                    label: 'Rating'
                }]
            });
            return sec;
        }

        function buildTestimonialsTemplate() {
            const sec = addSection(null, null, 3);
            sec.style.padding = '28px 14px';
            [
                ['Absolutely incredible!', 'Sarah Chen', 'Product Lead'],
                ['Changed our workflow.', 'Marcus Lee', 'CTO'],
                ['Best tool ever.', 'Priya Patel', 'Designer']
            ].forEach((q, i) => addWidget(sec.id, sec.cols[i].id, 'testimonial', {
                quote: q[0],
                author: q[1],
                role: q[2]
            }));
            return sec;
        }

        function buildCTATemplate() {
            const sec = addSection(null, null, 2, [60, 40]);
            sec.style.padding = '30px 18px';
            sec.style.background = 'linear-gradient(135deg,#5b52f0,#3b3680)';
            sec.style.borderRadius = '10px';
            addWidget(sec.id, sec.cols[0].id, 'heading', {
                text: 'Ready to get started?',
                sub: 'Join thousands of happy users today',
                level: 'h2'
            });
            addWidget(sec.id, sec.cols[1].id, 'button', {
                label: 'Start for Free →',
                href: '#',
                style: 'solid'
            });
            return sec;
        }

        // ============================
        // PANEL
        // ============================
        function switchTab(tab, el) {
            document.querySelectorAll('.panel-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            ['elements', 'templates', 'layers'].forEach(t => {
                document.getElementById(`tab-${t}`).style.display = t === tab ? '' : 'none';
            });
            if (tab === 'layers') updateLayers();
        }

        function updateLayers() {
            const tree = document.getElementById('layers-tree');
            if (!tree) return;

            function renderNode(node, depth = 0, parentList = sections) {
                const pad = 8 + depth * 14;

                // Div wrapper
                if (node.nodeType === 'div') {
                    let h =
                        `<div style="padding:3px 6px 3px ${pad}px;cursor:pointer;border-radius:3px;display:flex;align-items:center;gap:5px;font-size:10px;background:var(--surface2);margin-bottom:2px" onmouseover="this.style.background='var(--surface3)'" onmouseout="this.style.background='var(--surface2)'" onclick="selectDiv('${node.id}')"><i class="fa fa-code" style="color:#f59e0b;font-size:9px"></i><span>&lt;div${node.divClasses?' .'+node.divClasses.split(' ').join(' .'):''}&gt;</span></div>`;
                    if (node.children && node.children.length > 0) {
                        node.children.forEach(ch => h += renderNode(ch, depth + 1, node.children));
                    }
                    return h;
                }

                // Section/BS Row
                if (node.type === 'section' || node.type === 'bs-row') {
                    let h =
                        `<div style="padding:3px 6px 3px ${pad}px;cursor:pointer;border-radius:3px;display:flex;align-items:center;gap:5px;font-size:10px;background:var(--surface2);margin-bottom:2px" onmouseover="this.style.background='var(--surface3)'" onmouseout="this.style.background='var(--surface2)'" onclick="selectSection('${node.id}')"><i class="fa ${node.type==='bs-row'?'fa-grip':'fa-table-columns'}" style="color:var(--accent);font-size:9px"></i><span>${node.type==='bs-row'?'BS Row':'Section'} (${node.cols.length} cols)</span></div>`;
                    if (node.cols) {
                        node.cols.forEach(col => {
                            col.widgets.forEach(w => h += renderNode(w, depth + 1, col.widgets));
                        });
                    }
                    return h;
                }

                // Regular widget
                const comp = ALL_COMPONENTS.find(c => c.type === node.type);
                return `<div style="padding:2px 6px 2px ${pad}px;cursor:pointer;border-radius:3px;display:flex;align-items:center;gap:5px;font-size:10px;margin-bottom:1px" onmouseover="this.style.background='var(--surface3)'" onmouseout="this.style.background=''" onclick="selectWidget('${node.id}')"><i class="fa ${comp?comp.icon:'fa-puzzle-piece'}" style="color:var(--text3);font-size:9px"></i><span style="color:var(--text2)">${comp?comp.label:node.type}</span></div>`;
            }

            tree.innerHTML = sections.length === 0 ?
                '<div style="color:var(--text3);font-size:11px;padding:20px;text-align:center"><i class="fa fa-layer-group" style="font-size:24px;opacity:.3;display:block;margin-bottom:8px"></i>No elements yet</div>' :
                sections.map(s => renderNode(s, 0)).join('');
        }

        function renderComponents() {
            const groups = [{
                key: 'struct',
                gridId: 'struct-grid'
            }, {
                key: 'content',
                gridId: 'content-grid'
            }, {
                key: 'media',
                gridId: 'media-grid'
            }, {
                key: 'advanced',
                gridId: 'advanced-grid'
            }];
            groups.forEach(({
                key,
                gridId
            }) => {
                const grid = document.getElementById(gridId);
                if (!grid) return;
                (COMPONENTS[key] || []).forEach(comp => {
                    const item = document.createElement('div');
                    item.className = 'comp-item';
                    item.draggable = true;
                    item.innerHTML = `<i class="fa ${comp.icon}"></i><span>${comp.label}</span>`;
                    item.addEventListener('dragstart', e => {
                        activeDragType = comp.type;
                        item.classList.add('dragging-from-panel');
                    });
                    item.addEventListener('dragend', () => {
                        item.classList.remove('dragging-from-panel');
                        setTimeout(() => activeDragType = null, 100);
                    });
                    item.addEventListener('click', () => {
                        if (comp.type === 'section') {
                            addSection();
                            return;
                        }
                        if (comp.type === 'bs-row') {
                            addBsRowSection();
                            return;
                        }
                        if (comp.type === 'div-wrapper') {
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

        function renderTemplatePanelList() {
            const list = document.getElementById('tpl-list');
            SECTION_TEMPLATES.forEach(tpl => {
                const item = document.createElement('div');
                item.className = 'tpl-item';
                item.innerHTML =
                    `<i class="fa ${tpl.icon}"></i><div class="tpl-item-info"><h4>${tpl.label}</h4><p>${tpl.desc}</p></div><span class="tpl-badge">USE</span>`;
                item.addEventListener('click', () => {
                    saveHistory();
                    tpl.build();
                });
                list.appendChild(item);
            });
        }

        function openTemplateModal() {
            const grid = document.getElementById('tplModalGrid');
            grid.innerHTML = '';
            SECTION_TEMPLATES.forEach(tpl => {
                const card = document.createElement('div');
                card.className = 'modal-tpl-card';
                card.innerHTML =
                    `<div class="tpl-preview"><i class="fa ${tpl.icon}"></i></div><div class="tpl-meta"><h4>${tpl.label}</h4><p>${tpl.desc}</p></div>`;
                card.addEventListener('click', () => {
                    saveHistory();
                    tpl.build();
                    closeTplModal();
                });
                grid.appendChild(card);
            });
            document.getElementById('tplModal').style.display = 'flex';
        }

        function closeTplModal() {
            document.getElementById('tplModal').style.display = 'none';
        }

        // ROOT DROP
        function initRootDrop() {
            const rd = document.getElementById('root-drop');
            rd.addEventListener('dragover', e => {
                e.preventDefault();
                rd.classList.add('drag-over');
            });
            rd.addEventListener('dragleave', e => {
                if (!rd.contains(e.relatedTarget)) rd.classList.remove('drag-over');
            });
            rd.addEventListener('drop', e => {
                e.preventDefault();
                rd.classList.remove('drag-over');
                if (activeDragType) {
                    if (activeDragType === 'section') addSection();
                    else if (activeDragType === 'bs-row') addBsRowSection();
                    else if (activeDragType === 'div-wrapper') addDivWrapper();
                    else {
                        const s = addSection();
                        addWidget(s.id, s.cols[0].id, activeDragType);
                    }
                    activeDragType = null;
                }
            });
        }

        function setDevice(mode, btn) {
            document.querySelectorAll('.device-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('canvas-area').className = 'canvas-area ' + mode;
        }

        function previewPage() {
            const w = window.open('', '_blank');

            function renderNode(node) {
                if (node.nodeType === 'div') {
                    const s = node.inlineStyles || {};
                    const pad = buildSpacing(s.pt, s.pr, s.pb, s.pl, '');
                    const mar = buildSpacing(s.mt, s.mr, s.mb, s.ml, '');
                    const style =
                        `${s.background?'background:'+s.background+';':''}${pad?'padding:'+pad+';':''}${mar?'margin:'+mar+';':''}${s.border?'border:'+s.border+';':''}${s.borderRadius?'border-radius:'+s.borderRadius+';':''}${s.display?'display:'+s.display+';':''}${s.flexDirection?'flex-direction:'+s.flexDirection+';':''}${s.alignItems?'align-items:'+s.alignItems+';':''}${s.justifyContent?'justify-content:'+s.justifyContent+';':''}${s.gap?'gap:'+s.gap+';':''}${s.color?'color:'+s.color+';':''}${s.fontSize?'font-size:'+s.fontSize+';':''}${s.bgImage?'background-image:url('+s.bgImage+');background-size:'+(s.bgSize||'cover')+';background-position:'+(s.bgPosition||'center')+';':''}${node.divStyle||''}`;
                    let h =
                        `<div class="${node.divClasses||''}" style="${style}">${(node.children||[]).map(c=>renderNode(c)).join('')}</div>`;
                    return h;
                }
                if (node.type === 'section' || node.type === 'bs-row') {
                    const sty = node.style || {};
                    const pad = buildSpacing(sty.pt, sty.pr, sty.pb, sty.pl, sty.padding);
                    const mar = buildSpacing(sty.mt, sty.mr, sty.mb, sty.ml, sty.margin);
                    const bg = sty.bgImage ?
                        `background-image:url(${sty.bgImage});background-size:${sty.bgSize||'cover'};background-position:${sty.bgPosition||'center'};` :
                        '';
                    if (node.type === 'bs-row') {
                        return `<div class="row ${sty.classes||''}" style="${sty.background?'background:'+sty.background+';':''}${bg}${pad?'padding:'+pad+';':''}${mar?'margin:'+mar+';':''}">${node.cols.map(col=>`<div class="${col.bsCol||'col-md-6'}">${col.widgets.map(w=>renderNode(w)).join('')}</div>`).join('')}</div>`;
                    }
                    return `<div class="${sty.classes||''}" style="display:flex;flex-wrap:wrap;gap:${sty.gap||'0'};flex-direction:${sty.flexDirection||'row'};align-items:${sty.alignItems||'stretch'};justify-content:${sty.justifyContent||'flex-start'};${sty.background?'background:'+sty.background+';':''}${bg}${pad?'padding:'+pad+';':''}${mar?'margin:'+mar+';':''}${sty.border?'border:'+sty.border+';':''}${sty.borderRadius?'border-radius:'+sty.borderRadius+';':''}${sty.minHeight?'min-height:'+sty.minHeight+';':''}">${node.cols.map(col=>`<div style="flex:0 0 calc(${col.width||Math.floor(100/node.cols.length)}% - 3px)">${col.widgets.map(w=>renderNode(w)).join('')}</div>`).join('')}</div>`;
                }
                return `<div>${renderWidgetContent(node)}</div>`;
            }
            let html =
                '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Preview</title><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"><style>*{box-sizing:border-box;margin:0;padding:0}body{font-family:sans-serif}</style></head><body>';
            sections.forEach(s => html += renderNode(s));
            html += '</body></html>';
            w.document.write(html);
            w.document.close();
        }

        function saveData() {
            const json = JSON.stringify(sections, null, 2);
            console.log('SAVE:', json);
            const blob = new Blob([json], {
                type: 'application/json'
            });
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = 'page-data.json';
            a.click();
        }

        function previewData() {
            const json = JSON.stringify(sections);
            document.getElementById('previewJson').value = json;
            document.getElementById('previewForm').submit();
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
        saveHistory();
        renderCanvas();
        updateLayers();
    </script>
</body>

</html>
