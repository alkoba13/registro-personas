import { NgModule } from '@angular/core';
import { Routes } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { NgFor } from '@angular/common'; 
import { PersonListComponent } from './components/person-list/person-list.component';

export const routes: Routes = [
    { path: '', title:"Personas", component: PersonListComponent },
];

@NgModule({
    imports: [
      FormsModule,
      NgFor
    ]
  })
export class AppRoutingModule { }