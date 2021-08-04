<!DOCTYPE html>

<!---
Copyright 2017 The AMP Start Authors. All Rights Reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS-IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
-->

<html ⚡="">
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link rel="canonical" href="<?= curPageURL(); ?>" />
    <meta name="viewport" content="width=device-width" />
    <meta name="amp-google-client-id-api" content="googleanalytics" />
    <meta name="robots" content="index,follow"/>
    <meta name="keywords" content="<?= $keywords ?>" />
    <meta name="description" content="<?= $description ?>" />
    <script async="" src="https://cdn.ampproject.org/v0.js"></script>

    <style amp-boilerplate="">
      body {
        -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      }
      @-webkit-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @-moz-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @-ms-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @-o-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
    </style>
    <noscript
      ><style amp-boilerplate="">
        body {
          -webkit-animation: none;
          -moz-animation: none;
          -ms-animation: none;
          animation: none;
        }
      </style></noscript
    >

    <script
      custom-element="amp-carousel"
      src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"
      async=""
    ></script>
    <script
      custom-element="amp-sidebar"
      src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"
      async=""
    ></script>
    <script
      custom-element="amp-accordion"
      src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"
      async=""
    ></script>
    <script
      custom-element="amp-form"
      src="https://cdn.ampproject.org/v0/amp-form-0.1.js"
      async=""
    ></script>
    <script
      custom-element="amp-instagram"
      src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"
      async=""
    ></script>

    <style amp-custom="">
      /*! Bassplate | MIT License | http://github.com/basscss/bassplate */

      /*! normalize.css v5.0.0 | MIT License | github.com/necolas/normalize.css */
      html {
        font-family: sans-serif;
        line-height: 1.15;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }
      body {
        margin: 0;
      }
      article,
      aside,
      footer,
      header,
      nav,
      section {
        display: block;
      }
      h1 {
        font-size: 2em;
        margin: 0.67em 0;
      }
      figcaption,
      figure,
      main {
        display: block;
      }
      figure {
        margin: 1em 40px;
      }
      hr {
        box-sizing: content-box;
        height: 0;
        overflow: visible;
      }
      pre {
        font-family: monospace, monospace;
        font-size: 1em;
      }
      a {
        background-color: transparent;
        -webkit-text-decoration-skip: objects;
      }
      a:active,
      a:hover {
        outline-width: 0;
      }
      abbr[title] {
        border-bottom: none;
        text-decoration: underline;
        text-decoration: underline dotted;
      }
      b,
      strong {
        font-weight: inherit;
        font-weight: bolder;
      }
      code,
      kbd,
      samp {
        font-family: monospace, monospace;
        font-size: 1em;
      }
      dfn {
        font-style: italic;
      }
      mark {
        background-color: #ff0;
        color: #000;
      }
      small {
        font-size: 80%;
      }
      sub,
      sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline;
      }
      sub {
        bottom: -0.25em;
      }
      sup {
        top: -0.5em;
      }
      audio,
      video {
        display: inline-block;
      }
      audio:not([controls]) {
        display: none;
        height: 0;
      }
      img {
        border-style: none;
      }
      svg:not(:root) {
        overflow: hidden;
      }
      button,
      input,
      optgroup,
      select,
      textarea {
        font-family: sans-serif;
        font-size: 100%;
        line-height: 1.15;
        margin: 0;
      }
      button,
      input {
        overflow: visible;
      }
      button,
      select {
        text-transform: none;
      }
      [type='reset'],
      [type='submit'],
      button,
      html [type='button'] {
        -webkit-appearance: button;
      }
      [type='button']::-moz-focus-inner,
      [type='reset']::-moz-focus-inner,
      [type='submit']::-moz-focus-inner,
      button::-moz-focus-inner {
        border-style: none;
        padding: 0;
      }
      [type='button']:-moz-focusring,
      [type='reset']:-moz-focusring,
      [type='submit']:-moz-focusring,
      button:-moz-focusring {
        outline: 1px dotted ButtonText;
      }
      fieldset {
        border: 1px solid silver;
        margin: 0 2px;
        padding: 0.35em 0.625em 0.75em;
      }
      legend {
        box-sizing: border-box;
        color: inherit;
        display: table;
        max-width: 100%;
        padding: 0;
        white-space: normal;
      }
      progress {
        display: inline-block;
        vertical-align: baseline;
      }
      textarea {
        overflow: auto;
      }
      [type='checkbox'],
      [type='radio'] {
        box-sizing: border-box;
        padding: 0;
      }
      [type='number']::-webkit-inner-spin-button,
      [type='number']::-webkit-outer-spin-button {
        height: auto;
      }
      [type='search'] {
        -webkit-appearance: textfield;
        outline-offset: -2px;
      }
      [type='search']::-webkit-search-cancel-button,
      [type='search']::-webkit-search-decoration {
        -webkit-appearance: none;
      }
      ::-webkit-file-upload-button {
        -webkit-appearance: button;
        font: inherit;
      }
      details,
      menu {
        display: block;
      }
      summary {
        display: list-item;
      }
      canvas {
        display: inline-block;
      }
      [hidden],
      template {
        display: none;
      }
      .h00 {
        font-size: 4rem;
      }
      .h0,
      .h1 {
        font-size: 3rem;
      }
      .h2 {
        font-size: 2rem;
      }
      .h3 {
        font-size: 1.5rem;
      }
      .h4 {
        font-size: 1.125rem;
      }
      .h5 {
        font-size: 0.875rem;
      }
      .h6 {
        font-size: 0.75rem;
      }
      .font-family-inherit {
        font-family: inherit;
      }
      .font-size-inherit {
        font-size: inherit;
      }
      .text-decoration-none {
        text-decoration: none;
      }
      .bold {
        font-weight: 700;
      }
      .regular {
        font-weight: 400;
      }
      .italic {
        font-style: italic;
      }
      .caps {
        text-transform: uppercase;
        letter-spacing: 0.2em;
      }
      .left-align {
        text-align: left;
      }
      .center {
        text-align: center;
      }
      .right-align {
        text-align: right;
      }
      .justify {
        text-align: justify;
      }
      .nowrap {
        white-space: nowrap;
      }
      .break-word {
        word-wrap: break-word;
      }
      .line-height-1 {
        line-height: 1rem;
      }
      .line-height-2 {
        line-height: 1.125rem;
      }
      .line-height-3 {
        line-height: 1.5rem;
      }
      .line-height-4 {
        line-height: 2rem;
      }
      .list-style-none {
        list-style: none;
      }
      .underline {
        text-decoration: underline;
      }
      .truncate {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
      .list-reset {
        list-style: none;
        padding-left: 0;
      }
      .inline {
        display: inline;
      }
      .block {
        display: block;
      }
      .inline-block {
        display: inline-block;
      }
      .table {
        display: table;
      }
      .table-cell {
        display: table-cell;
      }
      .overflow-hidden {
        overflow: hidden;
      }
      .overflow-scroll {
        overflow: scroll;
      }
      .overflow-auto {
        overflow: auto;
      }
      .clearfix:after,
      .clearfix:before {
        content: ' ';
        display: table;
      }
      .clearfix:after {
        clear: both;
      }
      .left {
        float: left;
      }
      .right {
        float: right;
      }
      .fit {
        max-width: 100%;
      }
      .max-width-1 {
        max-width: 24rem;
      }
      .max-width-2 {
        max-width: 32rem;
      }
      .max-width-3 {
        max-width: 48rem;
      }
      .max-width-4 {
        max-width: 64rem;
      }
      .border-box {
        box-sizing: border-box;
      }
      .align-baseline {
        vertical-align: baseline;
      }
      .align-top {
        vertical-align: top;
      }
      .align-middle {
        vertical-align: middle;
      }
      .align-bottom {
        vertical-align: bottom;
      }
      .m0 {
        margin: 0;
      }
      .mt0 {
        margin-top: 0;
      }
      .mr0 {
        margin-right: 0;
      }
      .mb0 {
        margin-bottom: 0;
      }
      .ml0,
      .mx0 {
        margin-left: 0;
      }
      .mx0 {
        margin-right: 0;
      }
      .my0 {
        margin-top: 0;
        margin-bottom: 0;
      }
      .m1 {
        margin: 0.5rem;
      }
      .mt1 {
        margin-top: 0.5rem;
      }
      .mr1 {
        margin-right: 0.5rem;
      }
      .mb1 {
        margin-bottom: 0.5rem;
      }
      .ml1,
      .mx1 {
        margin-left: 0.5rem;
      }
      .mx1 {
        margin-right: 0.5rem;
      }
      .my1 {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
      }
      .m2 {
        margin: 1rem;
      }
      .mt2 {
        margin-top: 1rem;
      }
      .mr2 {
        margin-right: 1rem;
      }
      .mb2 {
        margin-bottom: 1rem;
      }
      .ml2,
      .mx2 {
        margin-left: 1rem;
      }
      .mx2 {
        margin-right: 1rem;
      }
      .my2 {
        margin-top: 1rem;
        margin-bottom: 1rem;
      }
      .m3 {
        margin: 1.5rem;
      }
      .mt3 {
        margin-top: 1.5rem;
      }
      .mr3 {
        margin-right: 1.5rem;
      }
      .mb3 {
        margin-bottom: 1.5rem;
      }
      .ml3,
      .mx3 {
        margin-left: 1.5rem;
      }
      .mx3 {
        margin-right: 1.5rem;
      }
      .my3 {
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
      }
      .m4 {
        margin: 2rem;
      }
      .mt4 {
        margin-top: 2rem;
      }
      .mr4 {
        margin-right: 2rem;
      }
      .mb4 {
        margin-bottom: 2rem;
      }
      .ml4,
      .mx4 {
        margin-left: 2rem;
      }
      .mx4 {
        margin-right: 2rem;
      }
      .my4 {
        margin-top: 2rem;
        margin-bottom: 2rem;
      }
      .mxn1 {
        margin-left: calc(0.5rem * -1);
        margin-right: calc(0.5rem * -1);
      }
      .mxn2 {
        margin-left: calc(1rem * -1);
        margin-right: calc(1rem * -1);
      }
      .mxn3 {
        margin-left: calc(1.5rem * -1);
        margin-right: calc(1.5rem * -1);
      }
      .mxn4 {
        margin-left: calc(2rem * -1);
        margin-right: calc(2rem * -1);
      }
      .m-auto {
        margin: auto;
      }
      .mt-auto {
        margin-top: auto;
      }
      .mr-auto {
        margin-right: auto;
      }
      .mb-auto {
        margin-bottom: auto;
      }
      .ml-auto,
      .mx-auto {
        margin-left: auto;
      }
      .mx-auto {
        margin-right: auto;
      }
      .my-auto {
        margin-top: auto;
        margin-bottom: auto;
      }
      .p0 {
        padding: 0;
      }
      .pt0 {
        padding-top: 0;
      }
      .pr0 {
        padding-right: 0;
      }
      .pb0 {
        padding-bottom: 0;
      }
      .pl0,
      .px0 {
        padding-left: 0;
      }
      .px0 {
        padding-right: 0;
      }
      .py0 {
        padding-top: 0;
        padding-bottom: 0;
      }
      .p1 {
        padding: 0.5rem;
      }
      .pt1 {
        padding-top: 0.5rem;
      }
      .pr1 {
        padding-right: 0.5rem;
      }
      .pb1 {
        padding-bottom: 0.5rem;
      }
      .pl1 {
        padding-left: 0.5rem;
      }
      .py1 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
      }
      .px1 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
      }
      .p2 {
        padding: 1rem;
      }
      .pt2 {
        padding-top: 1rem;
      }
      .pr2 {
        padding-right: 1rem;
      }
      .pb2 {
        padding-bottom: 1rem;
      }
      .pl2 {
        padding-left: 1rem;
      }
      .py2 {
        padding-top: 1rem;
        padding-bottom: 1rem;
      }
      .px2 {
        padding-left: 1rem;
        padding-right: 1rem;
      }
      .p3 {
        padding: 1.5rem;
      }
      .pt3 {
        padding-top: 1.5rem;
      }
      .pr3 {
        padding-right: 1.5rem;
      }
      .pb3 {
        padding-bottom: 1.5rem;
      }
      .pl3 {
        padding-left: 1.5rem;
      }
      .py3 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
      }
      .px3 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
      }
      .p4 {
        padding: 2rem;
      }
      .pt4 {
        padding-top: 2rem;
      }
      .pr4 {
        padding-right: 2rem;
      }
      .pb4 {
        padding-bottom: 2rem;
      }
      .pl4 {
        padding-left: 2rem;
      }
      .py4 {
        padding-top: 2rem;
        padding-bottom: 2rem;
      }
      .px4 {
        padding-left: 2rem;
        padding-right: 2rem;
      }
      .col {
        float: left;
      }
      .col,
      .col-right {
        box-sizing: border-box;
      }
      .col-right {
        float: right;
      }
      .col-1 {
        width: 8.33333%;
      }
      .col-2 {
        width: 16.66667%;
      }
      .col-3 {
        width: 25%;
      }
      .col-4 {
        width: 33.33333%;
      }
      .col-5 {
        width: 41.66667%;
      }
      .col-6 {
        width: 50%;
      }
      .col-7 {
        width: 58.33333%;
      }
      .col-8 {
        width: 66.66667%;
      }
      .col-9 {
        width: 75%;
      }
      .col-10 {
        width: 83.33333%;
      }
      .col-11 {
        width: 91.66667%;
      }
      .col-12 {
        width: 100%;
      }
      @media (min-width: 40.06rem) {
        .sm-col {
          float: left;
          box-sizing: border-box;
        }
        .sm-col-right {
          float: right;
          box-sizing: border-box;
        }
        .sm-col-1 {
          width: 8.33333%;
        }
        .sm-col-2 {
          width: 16.66667%;
        }
        .sm-col-3 {
          width: 25%;
        }
        .sm-col-4 {
          width: 33.33333%;
        }
        .sm-col-5 {
          width: 41.66667%;
        }
        .sm-col-6 {
          width: 50%;
        }
        .sm-col-7 {
          width: 58.33333%;
        }
        .sm-col-8 {
          width: 66.66667%;
        }
        .sm-col-9 {
          width: 75%;
        }
        .sm-col-10 {
          width: 83.33333%;
        }
        .sm-col-11 {
          width: 91.66667%;
        }
        .sm-col-12 {
          width: 100%;
        }
      }
      @media (min-width: 52.06rem) {
        .md-col {
          float: left;
          box-sizing: border-box;
        }
        .md-col-right {
          float: right;
          box-sizing: border-box;
        }
        .md-col-1 {
          width: 8.33333%;
        }
        .md-col-2 {
          width: 16.66667%;
        }
        .md-col-3 {
          width: 25%;
        }
        .md-col-4 {
          width: 33.33333%;
        }
        .md-col-5 {
          width: 41.66667%;
        }
        .md-col-6 {
          width: 50%;
        }
        .md-col-7 {
          width: 58.33333%;
        }
        .md-col-8 {
          width: 66.66667%;
        }
        .md-col-9 {
          width: 75%;
        }
        .md-col-10 {
          width: 83.33333%;
        }
        .md-col-11 {
          width: 91.66667%;
        }
        .md-col-12 {
          width: 100%;
        }
      }
      @media (min-width: 64.06rem) {
        .lg-col {
          float: left;
          box-sizing: border-box;
        }
        .lg-col-right {
          float: right;
          box-sizing: border-box;
        }
        .lg-col-1 {
          width: 8.33333%;
        }
        .lg-col-2 {
          width: 16.66667%;
        }
        .lg-col-3 {
          width: 25%;
        }
        .lg-col-4 {
          width: 33.33333%;
        }
        .lg-col-5 {
          width: 41.66667%;
        }
        .lg-col-6 {
          width: 50%;
        }
        .lg-col-7 {
          width: 58.33333%;
        }
        .lg-col-8 {
          width: 66.66667%;
        }
        .lg-col-9 {
          width: 75%;
        }
        .lg-col-10 {
          width: 83.33333%;
        }
        .lg-col-11 {
          width: 91.66667%;
        }
        .lg-col-12 {
          width: 100%;
        }
      }
      .flex {
        display: -ms-flexbox;
        display: flex;
      }
      @media (min-width: 40.06rem) {
        .sm-flex {
          display: -ms-flexbox;
          display: flex;
        }
      }
      @media (min-width: 52.06rem) {
        .md-flex {
          display: -ms-flexbox;
          display: flex;
        }
      }
      @media (min-width: 64.06rem) {
        .lg-flex {
          display: -ms-flexbox;
          display: flex;
        }
      }
      .flex-column {
        -ms-flex-direction: column;
        flex-direction: column;
      }
      .flex-wrap {
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
      }
      .items-start {
        -ms-flex-align: start;
        align-items: flex-start;
      }
      .items-end {
        -ms-flex-align: end;
        align-items: flex-end;
      }
      .items-center {
        -ms-flex-align: center;
        align-items: center;
      }
      .items-baseline {
        -ms-flex-align: baseline;
        align-items: baseline;
      }
      .items-stretch {
        -ms-flex-align: stretch;
        align-items: stretch;
      }
      .self-start {
        -ms-flex-item-align: start;
        align-self: flex-start;
      }
      .self-end {
        -ms-flex-item-align: end;
        align-self: flex-end;
      }
      .self-center {
        -ms-flex-item-align: center;
        -ms-grid-row-align: center;
        align-self: center;
      }
      .self-baseline {
        -ms-flex-item-align: baseline;
        align-self: baseline;
      }
      .self-stretch {
        -ms-flex-item-align: stretch;
        -ms-grid-row-align: stretch;
        align-self: stretch;
      }
      .justify-start {
        -ms-flex-pack: start;
        justify-content: flex-start;
      }
      .justify-end {
        -ms-flex-pack: end;
        justify-content: flex-end;
      }
      .justify-center {
        -ms-flex-pack: center;
        justify-content: center;
      }
      .justify-between {
        -ms-flex-pack: justify;
        justify-content: space-between;
      }
      .justify-around {
        -ms-flex-pack: distribute;
        justify-content: space-around;
      }
      .justify-evenly {
        -ms-flex-pack: space-evenly;
        justify-content: space-evenly;
      }
      .content-start {
        -ms-flex-line-pack: start;
        align-content: flex-start;
      }
      .content-end {
        -ms-flex-line-pack: end;
        align-content: flex-end;
      }
      .content-center {
        -ms-flex-line-pack: center;
        align-content: center;
      }
      .content-between {
        -ms-flex-line-pack: justify;
        align-content: space-between;
      }
      .content-around {
        -ms-flex-line-pack: distribute;
        align-content: space-around;
      }
      .content-stretch {
        -ms-flex-line-pack: stretch;
        align-content: stretch;
      }
      .flex-auto {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-width: 0;
        min-height: 0;
      }
      .flex-none {
        -ms-flex: none;
        flex: none;
      }
      .order-0 {
        -ms-flex-order: 0;
        order: 0;
      }
      .order-1 {
        -ms-flex-order: 1;
        order: 1;
      }
      .order-2 {
        -ms-flex-order: 2;
        order: 2;
      }
      .order-3 {
        -ms-flex-order: 3;
        order: 3;
      }
      .order-last {
        -ms-flex-order: 99999;
        order: 99999;
      }
      .relative {
        position: relative;
      }
      .absolute {
        position: absolute;
      }
      .fixed {
        position: fixed;
      }
      .top-0 {
        top: 0;
      }
      .right-0 {
        right: 0;
      }
      .bottom-0 {
        bottom: 0;
      }
      .left-0 {
        left: 0;
      }
      .z1 {
        z-index: 1;
      }
      .z2 {
        z-index: 2;
      }
      .z3 {
        z-index: 3;
      }
      .z4 {
        z-index: 4;
      }
      .border {
        border-style: solid;
        border-width: 1px;
      }
      .border-top {
        border-top-style: solid;
        border-top-width: 1px;
      }
      .border-right {
        border-right-style: solid;
        border-right-width: 1px;
      }
      .border-bottom {
        border-bottom-style: solid;
        border-bottom-width: 1px;
      }
      .border-left {
        border-left-style: solid;
        border-left-width: 1px;
      }
      .border-none {
        border: 0;
      }
      .rounded {
        border-radius: 12px;
      }
      .circle {
        border-radius: 50%;
      }
      .rounded-top {
        border-radius: 3px 3px 0 0;
      }
      .rounded-right {
        border-radius: 0 3px 3px 0;
      }
      .rounded-bottom {
        border-radius: 0 0 3px 3px;
      }
      .rounded-left {
        border-radius: 3px 0 0 3px;
      }
      .not-rounded {
        border-radius: 0;
      }
      .hide {
        position: absolute;
        height: 1px;
        width: 1px;
        overflow: hidden;
        clip: rect(1px, 1px, 1px, 1px);
      }
      @media (max-width: 40rem) {
        .xs-hide {
          display: none;
        }
      }
      @media (min-width: 40.06rem) and (max-width: 52rem) {
        .sm-hide {
          display: none;
        }
      }
      @media (min-width: 52.06rem) and (max-width: 64rem) {
        .md-hide {
          display: none;
        }
      }
      @media (min-width: 64.06rem) {
        .lg-hide {
          display: none;
        }
      }
      .display-none {
        display: none;
      }
      * {
        box-sizing: border-box;
      }
      body {
        background: #fff;
        color: #4a4a4a;
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen,
          Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, Arial,
          sans-serif;
        min-width: 315px;
        overflow-x: hidden;
        font-smooth: always;
        -webkit-font-smoothing: antialiased;
      }
      main {
        max-width: 700px;
        margin: 0 auto;
      }
      p {
        padding: 0;
        margin: 0;
      }
      .ampstart-accent {
        color: #003f93;
      }
      #content:target {
        margin-top: calc(0px - 3.5rem);
        padding-top: 3.5rem;
      }
      .ampstart-title-lg {
        font-size: 3rem;
        line-height: 3.5rem;
        letter-spacing: 0.06rem;
      }
      .ampstart-title-md {
        font-size: 2rem;
        line-height: 2.5rem;
        letter-spacing: 0.06rem;
      }
      .ampstart-title-sm {
        font-size: 1.5rem;
        line-height: 2rem;
        letter-spacing: 0.06rem;
      }
      .ampstart-subtitle,
      body {
        line-height: 1.5rem;
        letter-spacing: normal;
      }
      .ampstart-subtitle {
        color: #003f93;
        font-size: 1rem;
      }
      .ampstart-byline,
      .ampstart-caption,
      .ampstart-hint,
      .ampstart-label {
        font-size: 0.875rem;
        color: #4f4f4f;
        line-height: 1.125rem;
        letter-spacing: 0.06rem;
      }
      .ampstart-label {
        text-transform: uppercase;
      }
      .ampstart-footer,
      .ampstart-small-text {
        font-size: 0.75rem;
        line-height: 1rem;
        letter-spacing: 0.06rem;
      }
      .ampstart-card {
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.14),
          0 1px 1px -1px rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
      }
      .h1,
      h1 {
        font-size: 3rem;
        line-height: 3.5rem;
      }
      .h2,
      h2 {
        font-size: 2rem;
        line-height: 2.5rem;
      }
      .h3,
      h3 {
        font-size: 1.5rem;
        line-height: 2rem;
      }
      .h4,
      h4 {
        font-size: 1.125rem;
        line-height: 1.5rem;
      }
      .h5,
      h5 {
        font-size: 0.875rem;
        line-height: 1.125rem;
      }
      .h6,
      h6 {
        font-size: 0.75rem;
        line-height: 1rem;
      }
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        margin: 0;
        padding: 0;
        font-weight: 400;
        letter-spacing: 0.06rem;
      }
      a,
      a:active,
      a:visited {
        color: inherit;
      }
      .ampstart-btn {
        font-family: inherit;
        font-weight: inherit;
        font-size: 1rem;
        line-height: 1.125rem;
        padding: 0.7em 0.8em;
        text-decoration: none;
        white-space: nowrap;
        word-wrap: normal;
        vertical-align: middle;
        cursor: pointer;
        background-color: #000;
        color: #fff;
        border: 1px solid #fff;
      }
      .ampstart-btn:visited {
        color: #fff;
      }
      .ampstart-btn-secondary {
        background-color: #fff;
        color: #000;
        border: 1px solid #000;
      }
      .ampstart-btn-secondary:visited {
        color: #000;
      }
      .ampstart-btn:active .ampstart-btn:focus {
        opacity: 0.8;
      }
      .ampstart-btn[disabled],
      .ampstart-btn[disabled]:active,
      .ampstart-btn[disabled]:focus,
      .ampstart-btn[disabled]:hover {
        opacity: 0.5;
        outline: 0;
        cursor: default;
      }
      .ampstart-dropcap:first-letter {
        color: #000;
        font-size: 3rem;
        font-weight: 700;
        float: left;
        overflow: hidden;
        line-height: 3rem;
        margin-left: 0;
        margin-right: 0.5rem;
      }
      .ampstart-initialcap {
        padding-top: 1rem;
        margin-top: 1.5rem;
      }
      .ampstart-initialcap:first-letter {
        color: #000;
        font-size: 3rem;
        font-weight: 700;
        margin-left: -2px;
      }
      .ampstart-pullquote {
        border: none;
        border-left: 4px solid #000;
        font-size: 1.5rem;
        padding-left: 1.5rem;
      }
      .ampstart-byline time {
        font-style: normal;
        white-space: nowrap;
      }
      .amp-carousel-button-next {
        background-image: url('data:image/svg+xml;charset=utf-8,<svg width="18" height="18" viewBox="0 0 34 34" xmlns="http://www.w3.org/2000/svg"><title>Next</title><path d="M25.557 14.7L13.818 2.961 16.8 0l16.8 16.8-16.8 16.8-2.961-2.961L25.557 18.9H0v-4.2z" fill="%23FFF" fill-rule="evenodd"/></svg>');
      }
      .amp-carousel-button-prev {
        background-image: url('data:image/svg+xml;charset=utf-8,<svg width="18" height="18" viewBox="0 0 34 34" xmlns="http://www.w3.org/2000/svg"><title>Previous</title><path d="M33.6 14.7H8.043L19.782 2.961 16.8 0 0 16.8l16.8 16.8 2.961-2.961L8.043 18.9H33.6z" fill="%23FFF" fill-rule="evenodd"/></svg>');
      }
      .ampstart-dropdown {
        min-width: 200px;
      }
      .ampstart-dropdown.absolute {
        z-index: 100;
      }
      .ampstart-dropdown.absolute > section,
      .ampstart-dropdown.absolute > section > header {
        height: 100%;
      }
      .ampstart-dropdown > section > header {
        background-color: #000;
        border: 0;
        color: #fff;
      }
      .ampstart-dropdown > section > header:after {
        display: inline-block;
        content: '+';
        padding: 0 0 0 1.5rem;
        color: #003f93;
      }
      .ampstart-dropdown > [expanded] > header:after {
        content: '–';
      }
      .absolute .ampstart-dropdown-items {
        z-index: 200;
      }
      .ampstart-dropdown-item {
        background-color: #000;
        color: #003f93;
        opacity: 0.9;
      }
      .ampstart-dropdown-item:active,
      .ampstart-dropdown-item:hover {
        opacity: 1;
      }
      .ampstart-footer {
        background-color: #fff;
        color: #000;
        padding-top: 5rem;
        padding-bottom: 5rem;
      }
      .ampstart-footer .ampstart-icon {
        fill: #000;
      }
      .ampstart-footer .ampstart-social-follow li:last-child {
        margin-right: 0;
      }
      .ampstart-image-fullpage-hero {
        color: #fff;
      }
      .ampstart-fullpage-hero-heading-text,
      .ampstart-image-fullpage-hero .ampstart-image-credit {
        -webkit-box-decoration-break: clone;
        box-decoration-break: clone;
        background: #000;
        padding: 0 1rem 0.2rem;
      }
      .ampstart-image-fullpage-hero > amp-img {
        max-height: calc(100vh - 3.5rem);
      }
      .ampstart-image-fullpage-hero > amp-img img {
        -o-object-fit: cover;
        object-fit: cover;
      }
      .ampstart-fullpage-hero-heading {
        line-height: 3.5rem;
      }
      .ampstart-fullpage-hero-cta {
        background: transparent;
      }
      .ampstart-readmore {
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.65) 0, transparent);
        color: #fff;
        margin-top: 5rem;
        padding-bottom: 3.5rem;
      }
      .ampstart-readmore:after {
        display: block;
        content: '⌄';
        font-size: 2rem;
      }
      .ampstart-readmore-text {
        background: #000;
      }
      @media (min-width: 52.06rem) {
        .ampstart-image-fullpage-hero > amp-img {
          height: 60vh;
        }
      }
      .ampstart-image-heading {
        color: #fff;
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.65) 0, transparent);
      }
      .ampstart-image-heading > * {
        margin: 0;
      }
      amp-carousel .ampstart-image-with-heading {
        margin-bottom: 0;
      }
      .ampstart-image-with-caption figcaption {
        color: #4f4f4f;
        line-height: 1.125rem;
      }
      amp-carousel .ampstart-image-with-caption {
        margin-bottom: 0;
      }
      .ampstart-input {
        max-width: 100%;
        width: 300px;
        min-width: 100px;
        font-size: 1rem;
        line-height: 1.5rem;
      }
      .ampstart-input [disabled],
      .ampstart-input [disabled] + label {
        opacity: 0.5;
      }
      .ampstart-input [disabled]:focus {
        outline: 0;
      }
      .ampstart-input > input,
      .ampstart-input > select,
      .ampstart-input > textarea {
        width: 100%;
        margin-top: 1rem;
        line-height: 1.5rem;
        border: 0;
        border-radius: 0;
        border-bottom: 1px solid #4a4a4a;
        background: none;
        color: #4a4a4a;
        outline: 0;
      }
      .ampstart-input > label {
        color: #003f93;
        pointer-events: none;
        text-align: left;
        font-size: 0.875rem;
        line-height: 1rem;
        opacity: 0;
        animation: 0.2s;
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        animation-fill-mode: forwards;
      }
      .ampstart-input > input:focus,
      .ampstart-input > select:focus,
      .ampstart-input > textarea:focus {
        outline: 0;
      }
      .ampstart-input > input:focus:-ms-input-placeholder,
      .ampstart-input > select:focus:-ms-input-placeholder,
      .ampstart-input > textarea:focus:-ms-input-placeholder {
        color: transparent;
      }
      .ampstart-input > input:focus::placeholder,
      .ampstart-input > select:focus::placeholder,
      .ampstart-input > textarea:focus::placeholder {
        color: transparent;
      }
      .ampstart-input > input:not(:placeholder-shown):not([disabled]) + label,
      .ampstart-input > select:not(:placeholder-shown):not([disabled]) + label,
      .ampstart-input
        > textarea:not(:placeholder-shown):not([disabled])
        + label {
        opacity: 1;
      }
      .ampstart-input > input:focus + label,
      .ampstart-input > select:focus + label,
      .ampstart-input > textarea:focus + label {
        animation-name: a;
      }
      @keyframes a {
        to {
          opacity: 1;
        }
      }
      .ampstart-input > label:after {
        content: '';
        height: 2px;
        position: absolute;
        bottom: 0;
        left: 45%;
        background: #003f93;
        transition: 0.2s;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        visibility: hidden;
        width: 10px;
      }
      .ampstart-input > input:focus + label:after,
      .ampstart-input > select:focus + label:after,
      .ampstart-input > textarea:focus + label:after {
        left: 0;
        width: 100%;
        visibility: visible;
      }
      .ampstart-input > input[type='search'] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
      }
      .ampstart-input > input[type='range'] {
        border-bottom: 0;
      }
      .ampstart-input > input[type='range'] + label:after {
        display: none;
      }
      .ampstart-input > select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
      }
      .ampstart-input > select + label:before {
        content: '⌄';
        line-height: 1.5rem;
        position: absolute;
        right: 5px;
        zoom: 2;
        top: 0;
        bottom: 0;
        color: #003f93;
      }
      .ampstart-input-chk,
      .ampstart-input-radio {
        width: auto;
        color: #4a4a4a;
      }
      .ampstart-input input[type='checkbox'],
      .ampstart-input input[type='radio'] {
        margin-top: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border: 1px solid #003f93;
        vertical-align: middle;
        margin-right: 0.5rem;
        text-align: center;
      }
      .ampstart-input input[type='radio'] {
        border-radius: 20px;
      }
      .ampstart-input input[type='checkbox']:not([disabled]) + label,
      .ampstart-input input[type='radio']:not([disabled]) + label {
        pointer-events: auto;
        animation: none;
        vertical-align: middle;
        opacity: 1;
        cursor: pointer;
      }
      .ampstart-input input[type='checkbox'] + label:after,
      .ampstart-input input[type='radio'] + label:after {
        display: none;
      }
      .ampstart-input input[type='checkbox']:after,
      .ampstart-input input[type='radio']:after {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        content: ' ';
        line-height: 1.4rem;
        vertical-align: middle;
        text-align: center;
        background-color: #fff;
      }
      .ampstart-input input[type='checkbox']:checked:after {
        background-color: #003f93;
        color: #fff;
        content: '✓';
      }
      .ampstart-input input[type='radio']:checked {
        background-color: #fff;
      }
      .ampstart-input input[type='radio']:after {
        top: 3px;
        bottom: 3px;
        left: 3px;
        right: 3px;
        border-radius: 12px;
      }
      .ampstart-input input[type='radio']:checked:after {
        content: '';
        font-size: 3rem;
        background-color: #003f93;
      }
      .ampstart-input > label,
      _:-ms-lang(x) {
        opacity: 1;
      }
      .ampstart-input > input:-ms-input-placeholder,
      _:-ms-lang(x) {
        color: transparent;
      }
      .ampstart-input > input::placeholder,
      _:-ms-lang(x) {
        color: transparent;
      }
      .ampstart-input > input::-ms-input-placeholder,
      _:-ms-lang(x) {
        color: transparent;
      }
      .ampstart-input > select::-ms-expand {
        display: none;
      }
      .ampstart-headerbar {
        background-color: #fff;
        color: #000;
        z-index: 999;
        box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.1);
      }
      .ampstart-headerbar + :not(amp-sidebar),
      .ampstart-headerbar + amp-sidebar + * {
        margin-top: 3.5rem;
      }
      .ampstart-headerbar-nav .ampstart-nav-item {
        padding: 0 1rem;
        background: transparent;
        opacity: 0.8;
      }
      .ampstart-headerbar-nav {
        line-height: 3.5rem;
      }
      .ampstart-nav-item:active,
      .ampstart-nav-item:focus,
      .ampstart-nav-item:hover {
        opacity: 1;
      }
      .ampstart-navbar-trigger:focus {
        outline: none;
      }
      .ampstart-nav a,
      .ampstart-navbar-trigger,
      .ampstart-sidebar-faq a {
        cursor: pointer;
        text-decoration: none;
      }
      .ampstart-nav .ampstart-label {
        color: inherit;
      }
      .ampstart-navbar-trigger {
        line-height: 3.5rem;
        font-size: 2rem;
      }
      .ampstart-headerbar-nav {
        -ms-flex: 1;
        flex: 1;
      }
      .ampstart-nav-search {
        -ms-flex-positive: 0.5;
        flex-grow: 0.5;
      }
      .ampstart-headerbar .ampstart-nav-search:active,
      .ampstart-headerbar .ampstart-nav-search:focus,
      .ampstart-headerbar .ampstart-nav-search:hover {
        box-shadow: none;
      }
      .ampstart-nav-search > input {
        border: none;
        border-radius: 3px;
        line-height: normal;
      }
      .ampstart-nav-dropdown {
        min-width: 200px;
      }
      .ampstart-nav-dropdown amp-accordion header {
        background-color: #fff;
        border: none;
      }
      .ampstart-nav-dropdown amp-accordion ul {
        background-color: #fff;
      }
      .ampstart-nav-dropdown .ampstart-dropdown-item,
      .ampstart-nav-dropdown .ampstart-dropdown > section > header {
        background-color: #fff;
        color: #000;
      }
      .ampstart-nav-dropdown .ampstart-dropdown-item {
        color: #003f93;
      }
      .ampstart-sidebar {
        background-color: #fff;
        color: #000;
        min-width: 300px;
        width: 300px;
      }
      .ampstart-sidebar .ampstart-icon {
        fill: #003f93;
      }
      .ampstart-sidebar-header {
        line-height: 3.5rem;
        min-height: 3.5rem;
      }
      .ampstart-sidebar .ampstart-dropdown-item,
      .ampstart-sidebar .ampstart-dropdown header,
      .ampstart-sidebar .ampstart-faq-item,
      .ampstart-sidebar .ampstart-nav-item,
      .ampstart-sidebar .ampstart-social-follow {
        margin: 0 0 2rem;
      }
      .ampstart-sidebar .ampstart-nav-dropdown {
        margin: 0;
      }
      .ampstart-sidebar .ampstart-navbar-trigger {
        line-height: inherit;
      }
      .ampstart-navbar-trigger svg {
        pointer-events: none;
      }
      .ampstart-related-article-section {
        border-color: #4a4a4a;
      }
      .ampstart-related-article-section .ampstart-heading {
        color: #4a4a4a;
        font-weight: 400;
      }
      .ampstart-related-article-readmore {
        color: #000;
        letter-spacing: 0;
      }
      .ampstart-related-section-items > li {
        border-bottom: 1px solid #4a4a4a;
      }
      .ampstart-related-section-items > li:last-child {
        border: none;
      }
      .ampstart-related-section-items .ampstart-image-with-caption {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: center;
        align-items: center;
        margin-bottom: 0;
      }
      .ampstart-related-section-items .ampstart-image-with-caption > amp-img,
      .ampstart-related-section-items
        .ampstart-image-with-caption
        > figcaption {
        -ms-flex: 1;
        flex: 1;
      }
      .ampstart-related-section-items
        .ampstart-image-with-caption
        > figcaption {
        padding-left: 1rem;
      }
      @media (min-width: 40.06rem) {
        .ampstart-related-section-items > li {
          border: none;
        }
        .ampstart-related-section-items
          .ampstart-image-with-caption
          > figcaption {
          padding: 1rem 0;
        }
        .ampstart-related-section-items .ampstart-image-with-caption > amp-img,
        .ampstart-related-section-items
          .ampstart-image-with-caption
          > figcaption {
          -ms-flex-preferred-size: 100%;
          flex-basis: 100%;
        }
      }
      .ampstart-social-box {
        display: -ms-flexbox;
        display: flex;
      }
      .ampstart-social-box > amp-social-share {
        background-color: #000;
      }
      .ampstart-icon {
        fill: #003f93;
      }
      .ampstart-input {
        width: 100%;
      }
      main .ampstart-social-follow {
        margin-left: auto;
        margin-right: auto;
        width: 315px;
      }
      main .ampstart-social-follow li {
        transform: scale(1.8);
      }
      h1 + .ampstart-byline time {
        font-size: 1.5rem;
        font-weight: 400;
      }
    </style>
  </head>
  <body>
    <!-- Start Navbar -->
    <header
      class="ampstart-headerbar fixed flex justify-start items-center top-0 left-0 right-0 pl2 pr4"
    >
      <a class="text-decoration-none flex items-center ampstart-label" href="<?= base_url('beranda') ?>"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle mr1" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
      </svg>
        Back 
      </a>
      <amp-img
        src="<?= img_blob($site->site_logo) ?>"
        width="160"
        height="50"
        layout="fixed"
        class="my0 mx-auto"
        alt="<?= $site->site_title ?>"
      ></amp-img>
    </header>


    <!-- End Navbar -->
    <main id="content" role="main">
      <article class="recipe-article">
        <header>
          <span class="ampstart-subtitle block px3 pt2 mb2 caps"><?= $postCategory ?></span>
          <h4 class="mb1 px3 bold"><?= $title ?></h4>

          <!-- Start byline -->
          <address class="ampstart-byline clearfix mb4 px3 h5 flex justify-start">
            <amp-img
              src="<?= $postAuthorPic ?>"
              width="30"
              height="30"
              class="circle"
              alt="<?= $postAuthor ?>"
            ></amp-img>
            <time
              class="ampstart-byline-pubdate ampstart-small-text block bold my1 ml2"
              datetime="<?= $post->tgl_posting ?>"
              ><?= $postAuthor ?> &bull; <?= $postDatetime ?></time
            >
          </address>
          <!-- End byline -->
          <amp-img
            src="<?= $postImage ?>"
            width="1280"
            height="853"
            layout="responsive"
            alt="The final spritzer"
            class="mb4 mx3 rounded ampstart-card"
          ></amp-img>
        </header>
        <section class="mb4 px3">
          <?= $postContent ?>
          <div class="flex justify-between items-center mt3">
            <div class="flex justify-start">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
              </span>
              <span class="ml2">
                <?= $postView  ?>
              </span> 
            </div>
            <div class="flex justify-start align-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
              </svg>
              </span>
              <span class="ml2">
                <?= $post->like_count;  ?>
              </span> 
            </div>
            <div class="flex justify-start align-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                  <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
              </span>
              <span class="ml2">
                <?= $postComment ?>
              </span> 
            </div>
            <div class="flex justify-start align-center">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                  <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                </svg>
              </span>
              <span class="ml2">
                <?= $post->share_count  ?>
              </span> 
            </div>
            
          </div>
          <!-- <div class="mt3 border-top ampstart-related-article-section">
            
          </div> -->
        </section>
        <section class="mb4 px3">
          <b>Link versi desktop</b>
          <a href="<?= base_url("blog/{$postSlug}") ?>">
            <?= base_url("blog/{$postSlug}") ?>
          </a>
        </section>
      </article>
    </main>

    <!-- Start Footer -->
    <footer class="ampstart-footer flex flex-column items-center px3">
      <nav class="ampstart-footer-nav">
        <ul class="list-reset flex flex-wrap mb3">
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="<?= base_url('beranda') ?>">Home</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" target="_blank" href="https://www.buymeacoffee.com/putrabungsu6">Depelover</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="https://wa.me/+6282151811532">Contact</a>
          </li>
          <li class="px1">
            <a class="text-decoration-none ampstart-label" href="<?= base_url('kebijakan-privacy-policy') ?>">Privacy</a>
          </li>
        </ul>
      </nav>
      <p class="ampstart-small-text center"> &copy; <?= $site->site_title ?>, <?= date('Y') ?> <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
</svg> AMP Version </p>
    </footer>
    <!-- End Footer -->
  </body>
</html>