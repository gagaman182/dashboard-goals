<template>
  <div class="container-fluid">
    <goal1></goal1>

    <goal2></goal2>

    <goal3></goal3>

    <goal4></goal4>

    <goal5></goal5>
  </div>
</template>

<script>
import goal1 from '@/components/goal1'
import goal2 from '@/components/goal2'
import goal3 from '@/components/goal3'
import goal4 from '@/components/goal4'
import goal5 from '@/components/goal5'
import axios from 'axios'

export default {
  name: 'index',
  components: { goal1, goal2, goal3, goal4, goal5 },
  data: () => ({}),

  mounted() {},
  methods: {
    //goaltype
  },
}
</script>
