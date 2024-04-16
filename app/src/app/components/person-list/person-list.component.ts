import { Component } from '@angular/core';
import { PersonService } from '../../services/person.service';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-person-list',
  standalone: true,
  imports: [FormsModule,
    CommonModule, HttpClientModule, ],
  templateUrl: './person-list.component.html',
  styleUrl: './person-list.component.scss'
})
export class PersonListComponent {
  persons: any[] = [];
  currentPage: number = 1;
  pageSize: number = 10;
  searchQuery: string = '';
  orderBy: string | null = null;
  orderOperator: string | null = null;

  constructor(private personService: PersonService) { }

  ngOnInit(): void {
    this.getPersons();
  }

  getPersons(): void {
    this.personService.getPersons(this.currentPage, this.pageSize, this.searchQuery, this.orderBy, this.orderOperator)
      .subscribe((data: any) => {
        this.persons = data.data.data;
      });
  }

  onPageChange(page: number): void {
    this.currentPage = page;
    this.getPersons();
  }

  onSizeChange(event: Event) {

    const target = event.currentTarget as HTMLSelectElement | null;
    const value = target ? parseInt(target.value) : 10;
    this.pageSize = value;
    this.getPersons();
  }

  onSearch(): void {
    this.currentPage = 1;
    this.getPersons();
  }

  onOrderBy(event: Event) {
    const target = event.currentTarget as HTMLSelectElement | null;
    const value = target ? target.value : null;
    this.orderBy = value;
    this.getPersons();
  }

  onOrderOperator(event: Event) {
    const target = event.currentTarget as HTMLSelectElement | null;
    const value = target ? target.value : null;
    this.orderOperator = value;
    this.getPersons();
  }
}
