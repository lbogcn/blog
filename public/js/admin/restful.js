define(["ajax","jquery"],function(n,o){return{deny:function(o){confirm("确认禁用？")&&(n.loading(),n.apiPatch(o).done(function(){alert("操作成功，点击确定刷新页面！"),window.location.reload()}).always(function(){n.removeLoading()}))},restore:function(o){confirm("确认恢复？")&&(n.loading(),n.apiPatch(o).done(function(){alert("操作成功，点击确定刷新页面！"),window.location.reload()}).always(function(){n.removeLoading()}))},get:function(o,a){return n.loading(),n.apiGet(o,a).always(function(){n.removeLoading()})},post:function(o,a){n.loading(),n.apiPost(o,a).done(function(){alert("操作成功，点击确定刷新页面！"),window.location.reload()}).always(function(){n.removeLoading()})},put:function(o,a){n.loading(),n.apiPut(o,a).done(function(){alert("操作成功，点击确定刷新页面！"),window.location.reload()}).always(function(){n.removeLoading()})},patch:function(o,a){confirm("是否继续？")&&(n.loading(),n.apiPatch(o,a).done(function(){alert("操作成功，点击确定刷新页面！"),window.location.reload()}).always(function(){n.removeLoading()}))},del:function(o,a){confirm("确认删除？")&&(n.loading(),n.apiDelete(o,a).done(function(){alert("操作成功，点击确定刷新页面！"),window.location.reload()}).always(function(){n.removeLoading()}))}}});