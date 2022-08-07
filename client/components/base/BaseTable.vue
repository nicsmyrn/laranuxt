<template>
    <div class="master-div">
      <table class="table-class">
          <thead class="bg-gray-50">
            <tr>
              <slot name="header"></slot>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
              <slot name="body"></slot>
          </tbody>
        </table>
    </div>
</template>


