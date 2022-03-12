<script lang="ts">
  import { Link } from "svelte-routing";
  
  export let path: string;
</script>

<Link to={path}>
  <slot></slot>
</Link>

<style lang="scss">

</style>