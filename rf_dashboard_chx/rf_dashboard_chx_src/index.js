;(async function () {
    $(document).ready(async function () {
        // https://chat.openai.com/?q=%5Byour_prompt%5D
        // https://en.wikipedia.org/w/index.php?fulltext=1&search=php&title=Special%3ASearch&ns0=1
        // https://www.youtube.com/results?search_query=php
        // https://www.tokopedia.com/search?st=&q=gelas&srp_component_id=02.01.00.00&srp_page_id=&srp_page_title=&navsource=

        localStorage.clear()

        let isJoinActive = false
        let theTarget = '_self'
        const arrGoogleBtn = [
            'site:reddit.com',
            'site:quora.com',
            'site:github.com',
            'site:freecodecamp.org',
            'site:medium.com',
            'site:dev.to',
            'site:hackernoon.com',
            'site:codeproject.com',
            'site:forum.xda-developers.com',
            'site:tomshardware.com',
            'site:stackoverflow.com',
            'site:superuser.com',
            'site:serverfault.com',
            'site:askubuntu.com',
            'site:softwarerecs.stackexchange.com',
            'site:android.stackexchange.com',
            'site:raspberrypi.stackexchange.com',
            'site:freelancing.stackexchange.com',
        ]

        //
        if (q('q')) {
            location.href = `https://www.google.com/search?q=${q('q')}`
            $('#query').val(q('q'))
            return
        }

        //
        const doGoogle = function () {
            if (!isJoinActive) {
                $(this).attr(
                    'href',
                    `https://www.google.com/search?q=${$('#query').val()}`
                )
                return
            }

            //
            let orSyntax = ''
            for (let i = 0; i < localStorage.length; i++) {
                orSyntax =
                    orSyntax +
                    (localStorage.getItem(localStorage.key(i)) === 'true'
                        ? (i === 0 ? ' ' : ' OR ') + localStorage.key(i)
                        : '')
            }

            const totalQuery = $('#query').val() + orSyntax

            $(this).attr(
                'href',
                `https://www.google.com/search?q=${totalQuery}`
            )

            return
        }

        $(document).on('contextmenu', '#search', doGoogle)
        $('#search').click(doGoogle)

        //
        $(document).on('keypress', function (e) {
            if (e.which == 13) {
                $('#search').click()
				window.open(`https://www.google.com/search?q=${$('#query').val()}`,'_self');
                e.preventDefault()
                return false
            }
        })

        // Chat GPT
        {
            $('#placeholder').append(
                `<a id="btn-site-srch-chatgpt" class="all-btn btn btn-outline-light mx-2 my-2" href="#">ChatGPT</a>`
            )

            const doSearch = function () {
                const finalQuery = `https://chat.openai.com/?q=${$(
                    '#query'
                ).val()}`

                $(this).attr('href', finalQuery)
            }

            $(document).on('contextmenu', '#btn-site-srch-chatgpt', doSearch)
            $('#btn-site-srch-chatgpt').click(doSearch)
        }

        // Wikipedia
        {
            $('#placeholder').append(
                `<a id="btn-site-srch-wikipedia" class="all-btn btn btn-outline-light mx-2 my-2" href="#">Wikipedia</a>`
            )

            const doSearch = function () {
                const finalQuery = `https://en.wikipedia.org/w/index.php?fulltext=1&search=${$(
                    '#query'
                ).val()}&title=Special%3ASearch&ns0=1`

                $(this).attr('href', finalQuery)
            }

            $(document).on('contextmenu', '#btn-site-srch-wikipedia', doSearch)
            $('#btn-site-srch-wikipedia').click(doSearch)
        }

        // YouTube
        {
            $('#placeholder').append(
                `<a id="btn-site-srch-youtube" class="all-btn btn btn-outline-light mx-2 my-2" href="#">YouTube</a>`
            )

            const doSearch = function () {
                const finalQuery = `https://www.youtube.com/results?search_query=${$(
                    '#query'
                ).val()}`

                $(this).attr('href', finalQuery)
            }

            $(document).on('contextmenu', '#btn-site-srch-youtube', doSearch)
            $('#btn-site-srch-youtube').click(doSearch)
        }

        // Tokopedia
        {
            $('#placeholder').append(
                `<a id="btn-site-srch-tokopedia" class="all-btn btn btn-outline-light mx-2 my-2" href="#">Tokopedia</a>`
            )

            const doSearch = function () {
                const finalQuery = `https://www.tokopedia.com/search?q=${$(
                    '#query'
                ).val()}`

                $(this).attr('href', finalQuery)
            }

            $(document).on('contextmenu', '#btn-site-srch-tokopedia', doSearch)
            $('#btn-site-srch-tokopedia').click(doSearch)
        }

        // Joiner
        $(`#toggle-join`).click(function () {
            isJoinActive = !isJoinActive
            $(this).text(isJoinActive === true ? 'Join: On' : 'Join: Off')
            $(`.all-btn`).each(function (index) {
                $(this).attr(
                    'data-bs-toggle',
                    isJoinActive === true ? 'button' : ''
                )
            })
        })

        // Google Site
        arrGoogleBtn.forEach((item, index) => {
            $('#placeholder1').append(
                `<a id="btn-site-srch-${index}" class="all-btn btn btn-outline-danger mx-2 my-2" data-bs-toggle="" href="#">${item}</a>`
            )

            const doSearch = function () {
                const isToggleStateActive = isJoinActive
                console.log(isToggleStateActive)
                if (isToggleStateActive) {
                    if ($(this).attr('aria-pressed') === 'true') {
                        localStorage.setItem(item, 'true')
                    } else {
                        localStorage.removeItem(item)
                    }
                } else {
                    const finalQuery = `https://www.google.com/search?q=${$(
                        '#query'
                    ).val()}+${item}`

                    $(this).attr('href', finalQuery)
                }
            }

            $(document).on('contextmenu', `#btn-site-srch-${index}`, doSearch)
            $(`#btn-site-srch-${index}`).click(doSearch)
        })
    })

    //
    function q(variable) {
        var query = window.location.search.substring(1)
        var vars = query.split('&')
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split('=')
            if (pair[0] == variable) {
                return pair[1]
            }
        }
        return null
    }
})()
