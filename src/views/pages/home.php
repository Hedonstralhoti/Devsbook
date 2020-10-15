<?php $render('header', ['loggedUser'=>$loggedUser]); ?>
<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'home']);?>
<section class="feed mt-10">

            
            <div class="row">
                <div class="column pr-5" style="width: 800px;">

                    <?=$render('feed-editor', ['user'=>$loggedUser]);?>

                    <?php foreach($feed['posts'] as $feedItem): ?>
                        <?=$render('feed-item', ['data' => $feedItem, 'loggedUser' => $loggedUser]);?>
                    <?php endforeach; ?>
                    
                    <div class="feed-pagination">
                        <?php for($q=0;$q<$feed['pageCount'];$q++):?>
                            <a class="<?=($q==$feed['currentPage']?'active':'')?>" href="<?=$base;?>/?page=<?=$q;?>"><?=$q+1;?></a>
                        <?php endfor; ?>
                    </div>

                    
                
                </div>
                <div class="column side pl-5">
                    <div class="box banners">
                        <div class="box-header">
                            <div class="box-header-text">Patrocinios</div>
                            <div class="box-header-buttons">
                                
                            </div>
                        </div>
                        <div class="box-body">
                        <a href=""><img src="https://becode.com.br/wp-content/uploads/2017/09/php-post-1.png" /></a>
                        <a href=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXIAAACICAMAAADNhJDwAAAAkFBMVEX////vOy3xVEnuKhbvOCnuJxLuLBr4sazvNif6xMH95uXzfnf0ioT71dPuMSDwSDzyZFv2mpXuHwD7z8z/+fn5u7fxWU/2n5r96+r+8/LwRDfuJAz829n1kYv0g3z6yMXzdGz3p6Lya2LwTUH84d/yYFb4tbH4rqrwQDP2nZjzenLyaWD1lI73pqHxYVf0h4DOOqKTAAAKo0lEQVR4nO2daXuiOhSAwSzGLVpEBeO+Uqvt//93NwtI2Jxqa8udOe+HeSwQwBc4OVlkHAcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgB8jXP72GfxrHF2xbf32SfxLLLeIEy7eZr99Iv8KuxXhqNvbqH/D3z6Zf4FwLuT9vXPUvU4oX//2+fz9NDlF/aTqPGJKp1CPPpXhlnB6TP8O5158ywNPoV0SvndyGfmAkP4U/DPiYl9MUlpTxN1jSYGEZft5J/V3M0A4Kk/F1wx756piw60Qc/9pZ/VX08BuVOquvcIu75QXasuEklAa3XoKgCoazKWcFpJCvys4isqVh2dZuw56a07JFhKb+2mgY5Nz1Mi6O0YUTZddVKa8GVHqqlgULAQnKwjp99JATXlLo0xSqJJGdnGcMuVqHb/Ef+wGgntzSGzuQymX7vYyUYxDeqAC9Ul5LCoPNkiuC9IFLZdSfPipk/07MMplztdHlB9V0iijxcAkjXnlvuoVGPSyO1hTDiH9LhLljnOhMqSvZaC+Jo055U15R0ejwh6CDmFkExSWAxWkymV16DFZk06uKWNW+cHD7LV0H7Mx5m4x0fTbil1ts3d/p0/wx49rKZchvc/erNs1q/yVu3iciyoa/xy5Li1Wom2PS7zajnn01PnR7Y8fN6NctkXt+zirfMIjwsWqEEFUvOEuL1GOXAmqr3IiT481fvy4eeUv1l855Wi/G6gesEykGDaQTCiHqEw5/R8ox/VWPnackWoHpSXaJ5mYy6SxR0D5p7lTueO8MI62Q71EJZRorBJKUH4Hdyt3gpMnQ7qs6A/yjmcmaQTld3C/cpkUyraqmDdkyz/ZGpTfwSPKZUjHnDORtvxB+R08ptxxPrhr5eig/A4eVT4ifesvUH4HoPzHjwvKf/y4v6Y8GK7P89fWHT2Qfu94nr8cHppfMzu8zM/HXqbh/I8p760YoZxzRDeyFm6x6XQavakVQ/XR4jr+0e66SJdADdkWCFy1kkqFq0htlRv41nuJkh6r9jzSRSnBJ2v6SP2VX9De+iurfHaf8mAjmBvDvK7TIhhj9q5WDQXOkJyebOjipIR4D0OqVnpSuSmb6w88cbmQxt/lJS2Kuehc7/TaK5+NGbbGJzLKgxMv67ytUj7k3LVAq6Xakg30OuJmoPr0gj61F/L+TF8ypdzR+0KZXuVQrxW6KzxoZIq6fJr0kNdcefghOOIkndZlK58wTt6Lu65SLm/k+J5jWH/iY3xbeTBlSQmmS7BGdFU+V875h32Epuo2ZjpQBZEuyigiiJqPbuy81sr9CeVovOzIdn7S4kyVj6aURmUjzhXK29QY56g/brhEaTAaq5VvjXFGovFYTdyLSxjlO90tz+2acatWI/VM+n29f7RfL3vL4xvS17Zvtq2z8pEailZSh2m/SqJ8NhBcnEsH2yqUj829JuZqiC4cvieObeVYeAmyYjyb0CA2PRm9/NkieUqMcrNDZAW9ndAPhFr5oYpingyH9/TjQrvmj9oq7+0Jp4nUprylXfXtjPKg43FSHCgylCs/aKesf831DqigHI/DK74x6GJ63dEsYrbyg64JrHSqq0ON8trz9BORjm/6+oFB+uB1VR4uZDTZWOesJl3se0b5hHOyLRsO1ZQr1w89xtZlGpG8ctuf7s6REGs/bW4r9/Uloddr6EfqEEJVOxuWK+nMaHI56qmcno7yLm4MMyWCleBe50K3LSzv+BvThkqVD7UfkdmlcVql3NdreWYScItYyp0Fz2wwuu5Cn0FudFNvTNSnWirnjJsgnqW3RSrN4zKI35ocV6r8rL4x22eWBeKW8qUOPF72SA1mKTfByE3Wvet4rRpHTZp8StEbE3XJa6h818CMlNeMo6l8dsUfpoCWKh+zogXz/FcpNxdplS2xppZyE6xIXEcGno4z6hLpOxotAxt9Vnzi1FB5uKCcbCqkrtW3Gpavu1Kq3Ey0yP1q48JvKD/pi5Sbjt1DtvKLDiAb88dreon2+lmQybyFSUhPTv2UX3j1VMORzI057pevTClVrm9BnstxRuiG8jdWUgmbCjRRbiJTvNc+vlYW/SSbzKOPVS/lLZmJ57uKEmZjxOlLkz6k3NfKWU5565byQZnyIKPcWekn4XLdATZ9LtNK5aqxXCflszeZCFZMGw86sulzaue6tUqpvstprgO2metjySg3OnOV+C4Ty801M8+d3lzH6jjGu5wWEPVSHixQdRB/kQFeT0x8VLm+8fL3bPdWLDcNm3m2xCgTy5NUXJ5YqGMMMaevq2V+ORRRIbMmyun5yNRvVso3Psh4w8z99qhyXRlmO6EcB+MbyvUjkKaA1m5S5XHf1sJxjjSJG8lSUtVWq4lyJjPxqiDek0H8OnPlUeWmeU+D4rIq5abbKtOEjGeYWspNtwoOTRKabKzjTf76pt+nFsplK4K9VATxePphzKPKTb3HV9aiMMr3JGYb/LrZg/t2A+GN5ZSbfBCNjPpksnuoDyaylfU8qRbqofxD4PJ73H8VcRCP+bzyXJAyrXuUxuYw6ZqtUm5a93yc+l3Eow6W8oNJenKBXx+Mje2r9UHEwnyqh3IZOCnqF3+ccpiiZPphzKeV83laaTWHSQ7toqSCHiXDD5XK4+5enjQTZvtknMdSbgaCTFIori2tIL5a1wc3UGXpWB+7JsplTlLsHRyqV7RMspt9Wrmdo3kqrB7ijkNvP2ke5y65DmlWKt+ZEphMX47H10Y6bmopN417s501ELo2XcXope3rrnbPDNGpxmd9lOs548jqA1c/ShSdfJ/455VbmCd+kXSQy4uhB4Ixu63cOXixTFUiHk3LK++J5CjU/kYnczA1BDWeEnNZyMmUqI1yeS7vsrkTN4XMr8eLb7L4gnJnkR1sY+7xVl6uOHjZdiQ6FpSrtxHE+8vU/534UmBsuldcLOJQXyflZjxTvxpE//CwbCbKV5TLx90a4ufubnmrwa8ZujSVzsQozDb4FZf4cPkXDxwpt68Xv44u/Z7y8kGGCaNke1C/Hp+Urv+Mcg/l8JIUud0hlKmZKPIoi9BpqS2F9jzUH4s/U/PPDHE9s0U/dIHed0Z5EB/Oy/dwhl1GuD4aZoimL/bpqQJ//hrfToOvyvPwcIEYZWhRPrAZdvj0T7v2WwXSABUcN33XjcYTtf9Ar9SqQv2xrPXrjzrbyHW389l139nUahkfpKTo8jyeyqP1Vwfry1Yf6rmsBGcV74ubNVijorHcZJwMvnxs//5f4T5Q5BuKfjNHV2bi5VM1u2hRunx5o2sX+AT6ZQibsleAlr+PZbeR28PbK79Gu+J9cWXKw67q2oUX+n2ZYV9mEIWQXqJ8XR2GgDtp4mI3eUG5DuLwctbvIux6+YiRU95Wc4YWEMS/kbasFz07pGeU60sygJeXfTO57M9WLnNJ6sL7nJ7A2g7pqfKhGvSEIP4cwg+ZML6Z+JEoV0mkqGj5A9+Abup8pC/tM2+Th/8t4amouVruOlbelJn4FDLxp7PmFG2Hc7ToNQinlz8XAL5MuECcRm7EOSqMwQFPYvcusIvFOwTxH2Q5FdPi/ArgmfjL2vTqAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwP+U/sq/EEWv3MxcAAAAASUVORK5CYII=" /></a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body m-10">
                            Criado com ❤️ por B7Web
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
    <?php $render('footer'); ?>