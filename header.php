<!-- Fake ReactJS fingerprint -->
<script>
// Fake React DevTools global hook
window.__REACT_DEVTOOLS_GLOBAL_HOOK__ = {
  renderers: new Map(),
  supportsFiber: true
};

// Fake React version marker
window.React = { version: "18.2.0" };

// Fake React root attribute
document.addEventListener("DOMContentLoaded", () => {
  const fakeRoot = document.createElement("div");
  fakeRoot.setAttribute("data-reactroot", "");
  fakeRoot.style.display = "none";
  document.body.appendChild(fakeRoot);
});
</script>

<!-- Fake React script include -->
<script src="https://cdn.jsdelivr.net/npm/react@18.2.0/umd/react.production.min.js"></script>
