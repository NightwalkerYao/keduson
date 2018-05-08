<?php
$icons = [
'folder'=>'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAFcSURBVHhe7dOxSsNQAEbhPJxiHRR3F6n4DIIgWlQ6uTqIVIQOHYr0ATqJo4hLJxefQewmXLkSaMEUhNMbyM354SwhkNyPpHDOOeecc+3ezclGSNHt6eZl+Yi8Fw/7Pjlaa7PxYbg/78xbgZgCMNYaxFSAsV/EXucra8SUgLHsEVMDxsrfOU/EOgBjb6ODcHe29R2f1+RKtsXixaoDr7PnwX4Y9LbD00M3fL5chPnrVSOrHXA27obH670w7O+Ej+lx5Us1qVoBc/nqllsJmKJhfzeLr265eK6SbbF4sepm+5uAMAFhAsIEhAkIExAmIExAmIAwAWECwgSECQgTECYgTECYgDABYQLCBIQJCBMQJiBMQJiAMAFhAsIEhAkIExAmIExAmIAwAWECwgSECQgTECYgTECYgDABYQLCBIQJCBMQJiBMQJiAMAFhAsJWAtr/K9mcc84551wrVxQ/wtj6yJSY1LwAAAAASUVORK5CYII=', 
'html' => 'data:image/png;base64,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', 
'js' => 'data:image/png;base64,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', 
'php' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAmGSURBVHhe7Vt5UJTnGWem7fT8o9Ppf23+6jmdttNO22iPtNHJGE1qNfGoxmi1ZFInlaocyx7gRk1bYW9EDR4se3Ipl1GWS0SBXTSwsNygdSZJRcHKnSgYvr6/l2+RJe9yubsg8/5mfuP6PO/xPA/f977Pe3xhHBwcHBwcHBwcHBwcHBwcHBwcHBwcHEsT6kjbN1VR5mWJ0abXNLGWt3UKu80QZy/XK+zNOrmtSyu1DhD5sDrW8kAVYxJA/IYMOpRBWdRBXbSBto5I0p7V7D/1DbGbpYFkZdbXVFFpa9QSs9IQl1Guldp6tTLbJycO5/RZjxYPFJhdj8pyPcLVwnahpvyWUF99W2iu7RFa3P8T2urvCzeaByjxGzLo3KQMyqIO6qIN69GSfrSpkVoekCD3oi/0mRhtXA0bRHOeDqiiUn+libW+o1ekezSx5oenEwv68s3O0SsX2wTPtbsTQQkWPTV3BfSFPk8lnO9Vk6Dq5XaPVmo5nBBj+qVo5uKCOtL0c43UqtdJbd3Jb2cO5FuqR1xlN4UOTy/TyVCyndjgJLbkmatHkpWZA1q5tVsrs+rI0/kz0fyFgWZ/5pcTo807yV+3NSk+Y/C8tWbUXf1fphOLibCxwOoaMRCb9XJbS2J02g6l0vgl0a3gg0wAX9XKLFLyxPWb9Y6B6pIbQmdTP9PYxUzYDNtNOkc/eSL7CCVKZcpXRDcDD6Wy/PNkNowgk0Cv/VjZEAZzlmFPI+GL7VjJIHyDj/BVdDswIDPab0j60GnUXBisdy6dwE0lfEslPurk9g6SGv1adH/+SHkz5QsYcJPi0gcrHR3MToPBUodHePb5tcKL67Yz9cEmfDUQn+H7vJ9GdWTqM1q5rdGWVDzUSnIwVkfB4qmT+TSAuyOUTH0oCJ8thqJBxOCIxPJtMSyzA5kofqyTWXuKzrofsRoPNhUHDDSACSojUx9KOrLrRkly3q2KsvxIDM/0wJKIRL2PZPpjrAZDwa0799EAZmVWMPWhJknMx0j+2IdFghgmNjRS83cxEzlLbzIbCgU7GnuF363aQAN4vfoDZpmFYGVRx5hGZrmPGInh8sV4fmf9qLyg6VNWA6FieUkzDd6qdTuY+oXkpYKmUcQIsRLD9hhkzEtJf/fSx6yKM9E7Zvkjnqg/bggXYqQq4Xyei9mGl8bUC8w2JvP5NZuF9Vt2CxKZms7YU9sIpD1TmXG8bFgns50QwzYOjcS4PCkuY2jyDshcuD08mmmoP0ZEviM0u3uYbSkPHWPW8cflK9cLOWcrfdoIpD1T2ea+T1Ic+6DPxoRenl5WmtMw70kDTwQMed/JHrNa3PeEy6UtgkptElas+TMtG75bLnQwloA73oih+txzVZ/Reel5/65QVtxIn0CUfe0v+3z0gbSHxeJz9WM6ubWEBi8hxvIDfVz6UEdjH7PwTHRV3qIGvLB2G1M/lZXlHXR8Q50zZ97z0cGB36/eRHXumpk3Jppqu2nZ51ZtnJAF0h5/xC4TWa0MJ8Skfg/LtOiskxUPWAVnw3PZlbTzXW9KmXoW04yFtA6etsnyq+XtVP7Sq7t85P6IIKP8H1ZvnpAF0p7pmH3y8sdqiSkyzKBIdz3JMk2vt9PODxxMZupZrL9+m9ZZ8dIWH7nFXETle/Ye8pH7Y9HFelp+w7a3JmSBtGc60uWeIr06jCSIdxpcXcxCs2FkbALt/PSpAqaeRYxBqPPci49fPfDwP1OoHGPTZLk/pqTk0vKwwSsLpD3TERsPiB1e4ZG2J9g53vR6BO286IKbqWexuLCB1nmFpCKT5eG7ZVQ+dVb1R6lCR8sbkjImZIG0Zzq2N/QKJHYPnyiAWDX89oVXhWUr/kQHdFYZFhPJEwaDFQeSfOQrX95K5XU1H/nI/XHLjn/Q8nk51fT/gbZnOk4E8Ele4YqyVtrxyxv/ytSziHwL21SoV5D7OIl1XvkPla15ZadPeX/EWQeChTr118b3KANpz0zEK0xm4q4wvcLunO8k4h30Z7vt1FzXQ8uizuu7In10dnsZlb+196CP3B+9e4aTAx5Ie2ZipaNd0MdlVNE0JvtkxSesQjPxX0fO0M7x71RdY+1d4VrVLZqwIin+d0KqsHr9Tloer2rV5U6f8keIHjq8TpPl/sjaMwykPTMRaYwqxrwfR5Lf18fZ55VI/33fIWrAXLh5ewR91aa29bc98VR/NuvKZ3Qsete7CLxXFkh7piOGD70ifSgxOu07dDWiU9hKS3Lq57yUW7vpDaZR4PKV62hetXZjOE1QDx4+QccYfyd43nGo1vUhUz+V3j1DvPpeWSDtmY5kKfepTm4rosEDsDDGGcBcNhMw+C4nsx2WUbNdQwaTobIHW/3kjR1UR6X9QgzfOMhs/G7GiUvDrEosOi666V926kJ+oRgqe9KPXxrWyazHxLA9BjYJdTLbB7PdUEWmD4Mlcg1TH2qGwh5sqOpk9pu4lSGGzRfYrsa29VVHx4zjIdaaMDg5OZupDzWDbc/VwrYxnczSM+MJHQ5OcICCgxRWQ15itwMG5+c6mfpQM5j2VFxoHcNZEZl1fyqGaXrgCA9HeY7MWr/Hmthvg8F1rtktu4LNYNlTmIljTdsddaTxh2J4Zgc8quRJbLAYHEO43MhqfCmzpe6eYNI7Bkm6Uq/Zn/YtMSxzA641aGVWDVKcmV7ppUT4inMPjcymCshFIxw64cJNqvq9JX25CLe04CN56tpJVrJMdD8wyNqU9TkyS+/RyKy9uAr2NFymnC3hi/d6G3yEr6LbgQcuIWIDgqQ7fWm6wv6q4s6n9oJlVVGnYNQW9uNiuirGGuU3vwsGDBGGL6pjjNv0CrsH198KLK7RusrFMSNPx7rKD4V8i3PEEJ8+pFPYGtQxaVvhi+jWwkAjSf2JJtamIq9AFy5y55mqR5ylN+iuBcuJUBI7x7jKm5dW/fAosU0vs99WS62JuIEmmr+4gBv7Wim+C7G78YnB6YT8vjyTc+TKxVbB47rDdDKQ9NR0kVm0VcAfEX3DBmrL+HcjC3szf67A+ppk76vUEks8caKUrLXvaaTWB8cPne0zJxX1EycfleQ0THxog8G86Xq3QD+0cU/60Ib8hgw6lEFZfAuCumgDbaFNfJeCPtAX+R2HvpkXgZ5m6PYav47tM+LYFrXEFK+X2836OFuZQWFv1Mtst+lMSD/1Mk/61Ms8/qkX0aEMLUvqoC7aQFtoE22L3XBwcHBwcHBwcHBwcHBwcHBwcHBwcHAsKYSF/R9LhPADsuExCgAAAABJRU5ErkJggg==', 
'txt' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAANISURBVHhe7Zj5TxNBGIb5X4V4ETVRAjECiiAxBSGAFVC58eAoeIFCRUTkaiEFWqPigUfE20g0/jj2W7pfd8uSYj6lM/V9kyehM+8su0+6ze7kIAiCINuPr6Bd6UhNUedk4hT1Dp3ss9i6VtA5NVf2myFRV4E/f/wyQ6KuAilGSNRZIEV7iboLpGgt0QSBFG0lmiKQoqVEkwRStJNomkCKVhJNFEjRRqKpAilaSDRZICXjEk0XSMmoxGwQSMmYxGwRSMmIxGwSSNlxidkmkLKjEnUV+LdIXOa/C/0Tr4vIBiBQCAQKgUAhECgEAoVAoBAIFAKBQiBQCAQKgUAh2gmMzX9SQ1fCaZkbX1WRqTXXWDT0kY8TnnjN48NXF9RKdF2N9C+6+l7cux5znU86tBMYGn+lju1qSEugbcoSVpLn57EbXXN8nI7aOzzeWD5gjVUeauWxragv6eFjbAejBVK/6dQ1Hmso7ePjOGUFA0ubxrbCeIGRqXfKXxawICHOi6su7OK50fjtSP3g4DLPl+Sdtb6V4ck3PHZy/3n1ZOmb1W3x3eL1ZfuauVNx4CKPX/bfdZ1POrQT6OTRwhe+SIJ+w1I7JIckcacvom52h/hzV11w0xqCvml2h8R6dbaD8QKJzrrRpIyqIddtPTu26rkGAh1Mjz7nTnn+hfjt2WT9XV3U7dknIDCF04fbXV1isH3as0tAYAr9LZOubnGuXy2HPnh2CQhMgR6CnV16ZKGHZ68uAYEp1Jf2urrEw9srnl0CAh3QK11x7kandPc57rdWbS0GAh0EHL9/Pc0TLPP4nkYVW/jsuQYCHfiOdHBn/sFbVXP0En+mh2qvNRCYYCb4gucrDrZYY73xb6E9dqbQ+1kQAhPQq5o931Y9bI3N3XdvSMyMvdy0DgLjPKX34Pzke3BwYGPXhfAVJG/rjtoR1zoCAuPQ5qc9R/uC1LfnnLfxib2N6nHkq2vtfyFwJfrd2t6ySZVAu9f23OLMmmuOus619paWzfLse56LhpM72X+K1gJNAAKFQKAQCBQCgUIgUAgECoFAIRAoBAKFQKAQCBQCgUIgUAgECoFAIRAoBAKFQKAQCBQCgUJ2TGA2k7hMBEEQJG1ycn4DeXjhDKZ+DzkAAAAASUVORK5CYII=', 
'zip' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAARjSURBVHhe7ZvZa1RZEMbz140ObsR50hf1VQVHRMY33zQh0SToDIzDiEuGKAg+uOCGiYJZOgYVZpJRY/ck7sRBzapmOeY7XdXn2lbbNvfW7SRdH/wg3FrO6Y9z63SC1plMJpPJZDKZalurGnqcBj80dO+nJVa2pA+fFDVhIn/Yy8MLidHaOeZWN/TWhokaBoKaMVHLQFATJmoaCFa8idoGgqiJyx2yLYgD0gdPirauMbf+UOarzSxHyLYgDkgfPC7n/vnodrY/Kiy+q33Q3X0643LvFgpsP/F3IV7MkRtPv8itJrwnsi2IA5IBccCpq2+563vj9J3qfumywsZ2nJQNXErmAd4X2RYU3bQGOHUDz748dd8Cxkl9AMyWatKA95B3LaLoBpPkW6euHKVMxOsu5acB74FsC+KAVJQGK2YGSkVpsGJmoFRUDZbtDJSKqoXNwAqwGRgTm4EJYzMwAWwGVoDNwJjYDEwYm4EJYDOwAmwGxsRmYMLYDEwAm4EVYDMwJjYDE8ZmYALYDKwAm4ExsRmYALefTLg9HUOu/nB/YaNMfUu/jyFHqk0L3g/ZFsQBqSgNbj4cd+ua+wobLAVyOh+Niz3SgPdBtgVxQCpKA56BbVeybnxm1hXr/fSsa7407HPsFi7i3osPfu2NLRk3O7dAln2tT3PzPge5qJF6acM+kW1BHJCKtDl//41fe9+ZQbKqtJCDXNRIvbRhn8i2IA5IRdq0XRv1a//ZNUI2lRZykNt6fVTspQ37RLYFcUAq0ubn9vypuj30hmwqLeQgd/dfg2Ivbdgnsi2IA1KRNhsXv6Jg7RdvZ8im0kIOclEj9dKGfSLbgjggFWmSGZn26/7U2k8WlRdyUZMZnRZ7asI+kW1BHJCKNDk3MObX/Z4LhMUXCWqlnpqwT2RbEAekIk0quUBY1bxI2CeyLYgDUpEmezv+9eveilwg+C74R+eI23x0wAPDot8PkYuaX84+FHtqwj6RbUEckIo02fL7fb/u8KtJsse543TCouAZC7l4tnWxVuqpCe+HbAvigFSkCf+/kYnIr2+bjub/VX8UnEQWcvFsw+GM2FMT3g/ZFsQBqUgTNnDm0zzZU97A6Y9z/hlqpZ6a8H7ItiAOSEWabKNXeOj5BNlT/hVGLp5tO/ZA7KkJ74dsC+KAVKRJ46WcX/e36zmyJ3+JwDC+RPBz9BI5cjXra5ou/yf21IR9ItuCOCAVaXInO+lWN/a4tU197snrKbKotB4vXiBrmnrdj4297k5uSuypyZIzEBy4kD9ROG3R27hYMA85yG1YPLlSL23YJ7ItiANSkTbD/8+7Xafzv13gdP16LecGn437ywLgZ7y2iCEHf3xAjdRLG/aJbAvigFSUBjDk4MWsf515L8XgtT14MVc18wDvhWwL4oBUlCbd2Sl/OeCGxdcUgJ/xDDGpJk2WvIFLHTMwJmZgTMzAmJiBMTEDY1LWQOP7INuCpCSjNGSbyWQymUwmk6kmVVf3GVO1SXLKAEmoAAAAAElFTkSuQmCC', 
'audio' => 'data:image/png;base64,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',
'back' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAMcSURBVHhe7dfLaxNRFMfxrnShKLjRrW79IwS1SXDhrgX3CoruXcaNTLR0IbrwBdaluLcLC646k5ai0jYYQagQsEgUW1Ro8RHnZs4xl+HO486ZCdPk94UDaWF67/00ySQTCCGExrdqw+vZDF2GOBNS3NBliGOYja2/sQPAiAAoDIDCACgMgMIAKAyAwgAoDIDCACgMgMIAKAyAwgAoDIDCACgMgMIAKAyAwgAoDIDCACgMgMIAKAyAwkoNWGm4dXpY2koLqPCG/h/LUCkBGW9oCwrifZrQ9BnaeXS8oSwojPdpQtNnKOdhvNqtJgBt0/Ger3QBaFMYr/AFc4z3GQYLT2HnMeEVumDO8T51LNMUcp4ovMIWLCDep7530+R+nji8QhYsKN5neP/hyfU8SXi5L1hgvE/TGfTJ7Txp8NTktmDB8T5NZ9Anl/OkxVOTy4IFV6s3D6k9np9dNp6Bp9391T9LxfF26FL7bPDU7AXAasOdVnu8/GTNeAae5sefBOh26VK7bPHUlB2wMuse8UE6ao9zi5vGM/DMt74FgA3PpcvTlwVPTVkBzzZWDtccd4rxLj1e7X34+sd4Bp67C50A0PHu059JV1Y8NQxY5lF4bz7tGPevz8VHq3SNO000yUnw1OgbLdOoG8aVufX+yzbpmafG3Qje/6qO+2Ny5u0B4olPijdKc/3Ze8J3HxBPfMAbzMt3230832T3jLN8goiiA95g1jZ3exfuveaXr0NE0QFvMOq98drTVvDsc1xvqr6+j5iiqzreDQAGz7yr/k2G8Dqnb3pHiSi5cUdcaG//f9kGnxOXThJN+sYRUX1UGdxt1Xuet3ju9tIxIrFvlBHbX373PB9svrXV/4Yx+JAc3G3VDaN258V+osieFJE3tUfmuw/3cHKmeZyOn08SxNAGSzPBs8z77H8wbqrvturr2an6q4N05PzLisgbpj8z3mVBBGAoW0QAGrJBBGBEaREBGFMaRAAmlIQIwBTFIQIwZVGIALTIhAhAy8KIAMyQjgjAjDEiAAXpiPQrZBsj0o8oSwqRHiKEEBq5Jib+AVGNGmCYHI3tAAAAAElFTkSuQmCC',
'top_folder' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAARGSURBVHhe7drrUxpXGMdx/7h2mr5op+/7ppNO/4Q2HdvEWCurUm4qRu7sLpoIioqmiRGmmItCUYJG06TajJ3pNG1uXpK868yvexiIGB6MZoE9sueZ+b5hPCifWdizi21ixIgRI0aMGDFizD1D7R+gEXnPf/hj6Ve09rAXuzn1VV3bGP8SoYtnXpsCsRGALNMgNgqQVUTsPPOqpREbCchqecRGA7JKb+fWRGwGIKtw5Qv4Oz76j/2+01yJ7WDYg9QLrme3g58j2Pkxbspnsb/chdf57lNZ0wE3xs8ibvsMEekTbCfPkX/UaaqpgK1y1FVWE7ARRaRPW+Koq4y9rhLbwbAHqR8WVScAdSYAdSYAdSYAdSYAdSYAdSYAdSYAdcYdYFoZgPVruS5Rz1/vuDwC04ob3u4oNlaeYmtj/70yNSBLL6LpAVl6EAVgqfdFFIDlVrqh9AYwMjBHQtVKAGq90vBmhr0I9sVxP/+MhKqV6QH3chZEnQGorlk8XN0hkY7K1IA7GQkRawhjl25g894uCfSuTAv4dFFCwCJjMryArXUa5ziZEnAna4G/W8bV0QyJcpJMB7i3bNHOtiFMhm6RILVanN8itzimA5z1eHHZff1Eb9tkvABnu0LuE00FWJh0wtN1BQ/uvjiEUDMNeSayCE+njL9v9pKbbdMA7mYluC+oyC38eRipRpvre4h55iH3hvF8qefN87yNaBrAVGgIMW+qCorqwdoOItq+MOYKFPeJbz9XJaIpANmJY+B7FWvZxyRYZQxPtk9jot+PlyvVeOXKiKYAXJ2yQ3FMk2CV/a5tpmV7QjvyfNjX0KnnqowhmgLwms+D69E8iVYZuyIZcwSOhVeO3dmmHq93hgKGJBm59NEnjxsTeQSlMHaJzzweMhRw8IKC9dwTEo6Vv/MXBs6reKxtVaj1PGQooP1bBQ+1kwOFx1KdM1i63E+u5SVDAdlVBDu7UnjsrX2pUz3yjMtDhgJ6uhSsZugtTDy0gAV1kFzHU4YCRn6SkUn9QQKyvdx2so9cx1OGAv4iu5FQl0hAV7uKFxmJXMdThgKyI8zfEyUB2QmGXalQ63jKUED2jZtX+xzMph5VAbo7RvHv7YObBbxmLKDW2rQdsm2qClB1JrCesJNreMpwwOL3vn0y5icKhwDZJd7MsI9ew1HGA2r9c6sXQxdV/JrefgPIbkm5vlO5fxtzAch6NG/VLtsiWEoebGuujmaLX2+e5CZCs+MGkMUQh39Q8fNopnjnefPeHhRHApNuP/Zz9Bqj4wqQ9WyxB1FnED5LFOnZ+/jt7nOMDl5DWApjO2Ul1xgZd4DltuasGLGFMNgxgpgviYhrDrZvZIw5gijEHXhyh49NNreA5dhJZDnmxHh/ECFJ0faHKmznmvcvvO+Ke0DeE4A6E4A6E4A6E4A6E4A6E4A6qwkoOn4lNjFixIgRI0aMGDGmnLa2/wFiaxwxBO35dwAAAABJRU5ErkJggg==',
'video' => 'data:image/png;base64,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',
'java' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAnjSURBVHhe7VxrkBxVFd7wVF4hO6+QiqAQFBAxMtu9SwQn27N5gLx8rP4QkspO9yQEAyIlpbFMgNIESgTKQCCWwUDFB6ApRJMSkp3bs5ssD7dSSpZS8BE1qIRI2OzMbFghO37n9pnZ7pnZzcySNb3b/VWd6pl7T3ff+/U55557enbrfPjw4cOHDx8+qkO+tfVY/uhjNMjNbmzkjz5Gg0xcuT1/ZfQk/uqjVmQ0ZV1GU1v5q49aAfK6IBv4q49a0N8SPRMu/A6km5t81AIQ93A2ruazmvIqN/moFplmVcvE1UEiEMcXuNlHNeiNNc3Iauob0vokgcoj3OXjcOhtvvgcELa7QB5Jrrnxau72MRIycxouxIr7Lzt5IPO1fCx2HKv4GA79ceUSLBZv2smzRFnIKj6GA6zsS5CD5eSp6fzKumNYrQzZmDI129x4RV+8YSmlPNzsHeTr6iaBuO8UVluHaOp/cjF1OqtKkCtn4g0t0H/IFid7snOUmaziHQzOn3EiSHrcQRoL4uAApTGsWrdv1qxT0f41EPdvh66mrh1sano/q3kHvZdeOgXxTjjIYCFrJJcmPXLfjNZ4c1lsJOuMq9fIi3kNffNnhkBCj4MQm4C8m0jvrdjHTwdRW8t0NHXXwXjD2fJiXsP+luhkWNNLZaQURFOXF/RA5O9K+9H2zN5Y7BR5Ma9BLhia+qtSUgqCvtWsWgcif1HerzxFcZNVvIdss3p9KSlF0dSNRDDrzS3tp72wJxcLO0DSK6XEWKK051svOIHVKCf8pb0flpnzZI5nR9/c6Hl2UorkIC05EFcCrGbleZr6tkNPU3/G3d5FJbckKaQrBRxoaTy3gs5j3O1d5OINSgVi9pQWCTLxpo+V6sECd3G3d0ELAAjrdxKj/Jy7iyB3hgsfcuhBqNDAKt4FxTI7KYh/m7jLAfTtsOtZorRzt3dBG37kcu/aiNlnX30LyGnKZ2w6RYFlNrOKdwEi7ikhZgF3FUH5IKx1W4keubxgFe9icM5FJ8OS/lIgBZ93cpcDsqyP/M9BIITaWcW7kCutpvYWSMnEG2dzlwNw91vt5EnR1AR3exvylaWmDkgCscflZges4qnz5RIIvI27feQ09VoiEXKor6XxfG52AOSushNICwx3+SDQ+wzKDyGbuckBELZkiEBlP5W5uMtHATktqspSfYsyj5uKwMp7b4FAkCwLrRMbK8VxgaQ4L5Q0WwOGeWtQF3eHdLE+aIhNQd38bshIzz1roXgfaxfRP7fhAyDoh/atHVekrV8naOqD3Dw8WntOoPuGDLER9+rEPZ8NGuaKyQvF6azhUqzMHxNKmJ/FwB+H9IUMM18QTOB1TGZlOLEtwtrDIh+NHk/vSvgrckZlDbltNSvv5Bs6pxBZeFhbcL+MYwy62BvUOz7Mqu5CoG37qRj4dvuAh0TsHO3TJ7em+Dds+T7ZfXx9wjw/ZKQ+F9HTH+JWifplz58GEtfax4Ix9uARyYKtq4CBftU+UIfoYj9IXAcL+ErQSH0aupcF28xPhBd1nl0qwcXmuUE9FYXbN0P/ymAi/UXoJ2UYIMsyzPtCuvkEPSy078Z1B0jCuljCQykD+uERQ+PBGGLc5R6E9NQ8DHTQPtD/i+ji76FE6pM8jIqgB+Y8J30jd7kL4aS4FtbxB8dgx0TEACxwFz7/YNqNW4tV7OEA61Uc5+vmndzlToQTHRdh5dMx0XWwkBdx/CeO/3VMYmR5l895EUQ9BQtag+/foDhH8Y7iHt+qKoCwBY7r62IZd40f0CITQUyLLOj8KMU/inMFwYRmUvw7IymC02/pOuJv3Ogh2AmMGKnx8/cmtPpiAt+HFWUgZZXnsYZcoXVxyEbgHynd4m53Y2pb+1lwvVdsg98TSIjZo5oAzpGWa4hbQMj6qvK51ieOxcN7znb/PMVp7nU/rNg1NPii0Mqpix9D7gDB19OuIZgwrwgbogUB/+pwQlyH9husfvMniGG/xecD9msgxenH9ZePFA9B9l32c3CNe7hrfICCPgZtd5+xkG6KnXzLIihVKero5jt4ILe7MoE+HOoTaRWD32xNwjHxUQusLyevCSs9LdFVz7cqAjq3oY9zUvFC0EhfzF3jF1OSWydT/IFbPQCrTCE2/a0a64Sb7gNhO3BcGzDSi7HjaKpUhJBAzANh34NuBg/sp7Sb4Z6JA1oIKC+jyVLVJLJYfFBu4WAlxdQG2znpljUuNtYig20arstNEwcWSeJZy6rES7XFo/wkK3c0V+HcB91fljrCiFz3zMlw2T853FPuMsS3AgnzKtrLFq0PFmS5unkTuSOkHRbb6zzXfI2KEnz5iY9wwpzjIOAICR7AoxRb+TbjE/W6mE75GGQb3GtvYWGQn7FS1i/uuIDiGdr22Cf/nkUXr+IeBlW+eSjDIphMf4o/ugn5SXClO0HSQOnk4H6v0yqI4zdBbBL74GmRJTvC+LwGE99fql+VIA3C9Z7D+d/GdS6rJYbinC0490m5cLkFmMTqyhMVd4xYEMDKSlaJCbVZKYfYgOPTOFKqslUuNLJgKh6FzgprV5KeRdVlvkJNOCPZfZLlDWY+oKcdv0E8qsCA3nIQJ0X0uWmjPmPZlhPpYRTGJ13eLYClvewkjwdpmI8c9cCOuIjxfR5j6SmODSs5hRHWOPqgTT8srmIJX7qMLu4PJ81LqgnyRwJkbXBRDWFgFcb1D8d4DDNLxQpWdQ/oFSZi1Rv2wZYKyKR9awcs4F65wddT8wJt7R+h1498mZpAJfxIm7gQpFyO634ZQi+ruqz7VBqDeFpWsSsgkBQN/PHoIbRUnIKnvvxwRFYWrOCUFOvmn/G92yICCwkL+ttlO5JwsmpIv/P8yoJzMzh340jpC+2r4SUp/uoCIEWQLmSIB2jClSY2ZoLcE/fchePD9BqUVl4eVRmmJDvPxEP7tTwvabr3n/iQi9LPN0JJ8XVMbD1ZE8j9Kwb/Hspa4k1c62WQ9Rsc76d3wfTQqlm0pi7qCMGC7y5YMaVJ3DX+QBOmKgwVCIgAqkSTyJ+F2KvTiFEgaibtdkZXYUGyjxySHiBIP1h4EHDxta5KqiuBfgNDJaqxeMs2EqhWKC3fqgvuHrJeSdzucVWEIEsLJcQicje4zgZy57CeukbWBJeKqbWVtMpB1Wh6SQXrupmsDCRhITLftpMmiTPE72kctb5PdhWITEzuC5jsjyDWImO9bN8DcrswyU2wmnV2kTHLejF0H859DG2bcXxenl9a4rKLLGiIndBdTS/5eQgTC5TPwSLnY5LLyTohtBfeV5GQEQRkZkEYLSxPQlaQhVfzc48JC7mjaNs+jSyH3mnQYgJiLpc/1EyYV8nveipKyTH92oFP8+HDhw8fPnx4CHV1/wMdhTDQJnNEhQAAAABJRU5ErkJggg==',
'android' => 'data:image/png;base64,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',
'config' => 'data:image/png;base64,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'
];

?>